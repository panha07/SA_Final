<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\company_profile;
use App\Models\districts;
use App\Models\educations;
use App\Models\Educations_Detail;
use App\Models\employers;
use App\Models\gender;
use App\Models\Job;
use App\Models\job_categories;
use App\Models\job_type;
use App\Models\JobLang;
use App\Models\JobLocation;
use App\Models\jobs;
use App\Models\Lang_Details;
use App\Models\LangSkill;
use App\Models\language;
use App\Models\level;
use App\Models\Location;
use App\Models\LocationWorking;
use App\Models\province;
use App\Models\salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JobPostingController extends Controller
{
    public function index(Request $request)
    {
        
        $onlineJobs = Job::with('jobLocations.location.province', 'jobLocations.location.district', 'salary', 'jobType')
            ->where('status', 'online');

        // $allOfflineJobs = Job::where('status', 'offline')->get();
        $offlineJobs = Job::with('jobLocations.location.province', 'jobLocations.location.district', 'salary', 'jobType')
            ->where('status', 'offline');
        if (job::where('status', 'online')) {
            if ($request->has('search')) {
                $onlineJobs->where('title', 'like', '%' . $request->input('search') . '%');
            }
        }
        if (job::where('status', 'offline')) {

            if ($request->has('search')) {
                $offlineJobs->where('title', 'like', '%' . $request->input('search') . '%');
            }
        }

        $onlineJobs = $onlineJobs->orderBy('created_at', 'desc')->paginate(5);
        


        $offlineJobs = $offlineJobs->orderBy('created_at', 'desc')->paginate(5);
    
        $allOnlineJobs = Job::where('status', 'online')->get();
        $allOfflineJobs = Job::where('status', 'offline')->get();

        return view('backend.Job.index', compact('allOnlineJobs', 'allOfflineJobs', 'onlineJobs', 'offlineJobs'));
    }

    public function closeJob(Request $request, Job $job)

    {
        $job->status = 'offline';
        $job->save();

        return response()->json(['success' => true]);
    }
    public function renewJob(Request $request, Job $job)
    {
        $job->status = 'online';
        $job->save();

        return response()->json(['success' => true]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q'); // Get the search term
    
        // Fetch categories matching the query
        $categories = job_categories::where('name', 'LIKE', "%$query%")
            ->limit(10) // Limit results to 10 for performance
            ->get();
    
        // Format the response for Select2
        $formattedCategories = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'text' => $category->name,
            ];
        });
    
        return response()->json($formattedCategories);
    }



    public function create()
    {
        $provinces = province::select('id', 'province')->get();
        $jobCategory = job_categories::select('id', 'name')
        ->orderBy('name', 'asc')->get();
        $jobType = job_type::select("id", 'name')->where('status', 1)->get();
        $level = level::select("id", 'level')->where('status', 1)->get();
        $salary = salary::select("id", 'salary_rank')->get();
        $educations = educations::select("id", 'education')->get();
        $language = language::select("id", 'lang')->get();
        $language_skill = DB::table('skills')->select('id', 'skill')->get();
        $gender = gender::select("id", "gender")->where("status", 1)->get();

        $current_user = Auth::user()->id;
        $employers = employers::join('company_profiles', 'employers.company_profile_id', '=', 'company_profiles.id')
            ->select(
                'employers.id as employer_id',
                'employers.name as user_name',
                'employers.phone',
                'employers.department',
                'employers.position',
                'employers.email',
                'company_profiles.name',
                'company_profiles.logo',
                "company_profiles.id as company_id",
                'company_profiles.address as company_address',
                'company_profiles.website as company_website',
            )
            ->where('company_profiles.user_id', $current_user)
            ->get();

        return view(
            'backend.Job.add_job',
            compact(
                'provinces',
                'jobCategory',
                'jobType',
                'salary',
                'level',
                'educations',
                'language',
                'language_skill',
                'gender',
                'employers',
            )
        );
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_title' => 'required|string|max:255',
            'posted_at' => 'required|date',
            'job_type' => 'required|integer',
            'job_categories' => 'required|integer',
            'province' => 'required|array',
            'province.*' => 'required|integer',
            'district' => 'required|array',
            'district.*' => 'required|integer',
            'detail' => 'nullable|array',
            'detail.*' => 'nullable|string|max:255',
            'hiring_num' => 'required|integer|min:1',
            'salary_range' => 'required|integer',
            'description' => 'nullable|string',
            'level' => 'required|string|max:255',
            'education' => 'required|integer|max:255',
            'studyfield' => 'nullable|string|max:255',
            'experience' => 'required|integer|min:0',
            'lang.*' => 'nullable|string|max:255',
            'Lang_skill.*' => 'nullable|string|max:255',
            'gender' => 'required|integer|max:255',
            'startAge' => 'required|integer|min:18',
            'endAge' => 'required|integer|min:18',
            'requirements' => 'nullable|string',
            'employer' => 'required|integer',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);


        $validator->after(function ($validator) use ($request) {
            if ($request->startAge > $request->endAge) {
                $validator->errors()->add('startAge', 'The start age must be less than or equal to the end age.');
            }
        });

        if ($validator->fails()) {
            session()->flash('error', 'Please fill in all the required fields.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $current_user = Auth::user()->id;
        $company = company_profile::where('user_id', $current_user)->select('id')->first();

        $location = new LocationWorking();
        $location->province_id = $request->province[0];
        $location->district_id = $request->district[0];
        $location->desc = $request->detail[0];
        $location->save();

        foreach ($request->lang as $index => $lang_id) {
            if (isset($request->Lang_skill[$index])) {
                $language = new LangSkill();
                $language->lang_id = $lang_id;
                $language->skill_id = $request->Lang_skill[$index];
                $language->save();
            }
        }

        // dd($request->lang);
        // $language = new LangSkill();
        // $language->lang_id = $request->lang[0];
        // $language->skill_id = $request->Lang_skill[0];
        // $language->save();
        // // $language->lang_id = $request->lang[1];
        // // $language->skill_id = $request->Lang_skill[1];



        $job = new Job();
        $job->title = $request->job_title;
        $job->posted_at = $request->posted_at;
        $job->job_type_id = $request->job_type;
        $job->job_categories_id = $request->job_categories;
        $job->hiring_num = $request->hiring_num;
        $job->salary_id = $request->salary_range;
        $job->description = $request->description;
        $job->level_id = $request->level;
        $job->experience = $request->experience;
        $job->gender_id = $request->gender;
        $job->start_age = $request->startAge;
        $job->end_age = $request->endAge;
        $job->requirements = $request->requirements;
        $job->application_deadline = Carbon::parse($request->posted_at)->addDays(30); // Add 30 days to posted_at
        $job->company_profile_id = $company->id;
        $job->employer_id = $request->employer;
        $job->save();

        $educations = new Educations_Detail();
        $educations->job_id = $job->id;
        $educations->education_id = $request->education;
        $educations->field_of_study = $request->studyfield;
        $educations->save();

        $location_id = $location->id;

        $jobLocation = new JobLocation();
        $jobLocation->job_id = $job->id;
        $jobLocation->location_id = $location_id; // Assuming location_id is provided in the request
        $jobLocation->save();



        $language_id = $language->id;
        $language_skill = new JobLang();
        $language_skill->lang_skill_id = $language_id;
        $language_skill->job_id = $job->id;
        $language_skill->save();



        return redirect()->route('job')->with('success', 'Job posted successfully.');
    }
    public function getDistricts($provinceId)
    {
        $districts = districts::where('province_id', $provinceId)
        ->orderBy('district', 'desc')
        ->get();
        return response()->json($districts);
    }
    public function edit($id)
    {
        $job = Job::with('jobLocations.location.province', 'jobLocations.location.district', 'salary', 'jobType', 'jobCategories', 'levels', 'educations_Detail', 'jobLangSkills.langDetails')
            ->findOrFail($id);
        $provinces = province::select('id', 'province')->get();
        $jobCategories = job_categories::select('id', 'name')->get();
        $jobType = job_type::select("id", 'name')->where('status', 1)->get();
        $levels = level::select("id", 'level')->where('status', 1)->get();
        $salaries = salary::select("id", 'salary_rank')->get();
        $educations = educations::select("id", 'education')->get();
        $languages = language::select("id", 'lang')->get();
        $language_skill = DB::table('skills')->select('id', 'skill')->get();
        $job_lang_details = JobLang::select('id', 'job_id', 'lang_skill_id')->where('job_id', $job->id)->get();
        $langDetails = Lang_Details::select('id', 'lang_id', 'skill_id')->whereIn('id', $job_lang_details->pluck('lang_skill_id'))->first();
        $genders = gender::select('id', 'gender')->get();
        $educations_detail = Educations_Detail::select('id', 'education_id', 'job_id', 'field_of_study')->where('job_id', $job->id)->get();
        $current_user = Auth::user()->id;
        $employers = employers::join('company_profiles', 'employers.company_profile_id', '=', 'company_profiles.id')
            ->select(
                'employers.id as employer_id',
                'employers.name',
                'employers.phone',
                'employers.department',
                'employers.position',
                'employers.email',
                'company_profiles.name as company_name',
                'company_profiles.logo',
                "company_profiles.id as company_id",
                'company_profiles.address as company_address',
                'company_profiles.website as company_website',

            )
            ->where('company_profiles.user_id', $current_user)
            ->get();

        return view(
            'backend.Job.edit_job',
            compact(
                'job',
                'provinces',
                'jobCategories',
                'jobType',
                'salaries',
                'levels',
                'educations',
                'languages',
                'language_skill',
                'genders',
                'employers',
                'educations_detail',
                'job_lang_details',
                'langDetails'

            )
        );
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'job_type_id' => 'required|integer',
            'job_categories' => 'required|integer',
            'province' => 'required|array',
            'province.*' => 'required|integer',
            'district' => 'required|array',
            'district.*' => 'required|integer',
            // 'detail' => 'nullable|array',
            'detail' => 'nullable|string|max:255',
            'hiring_num' => 'required|integer|min:1',
            'salary_range' => 'required|integer',
            'description' => 'nullable|string',
            'level' => 'required|integer',
            'education' => 'nullable|string|max:255',
            'studyfield' => 'nullable|string|max:255',
            'experience' => 'required|integer|min:0',
            'languages.*' => 'nullable|integer',
            'Lang_skill.*' => 'nullable|integer',
            'gender' => 'required|integer|in:1,2,3',
            'startAge' => 'required|integer|min:18',
            'endAge' => 'required|integer|min:18',
            'requirements' => 'nullable|string',
            'employer' => 'required|integer',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            session()->flash('error', 'Please fill in all the required fields.');
            return redirect()->back()->withErrors($validator)->withInput();
        }



        $job = Job::findOrFail($id);

        $job->title = $request->title;
        $job->job_type_id = $request->job_type_id;
        $job->job_categories_id = $request->job_categories;
        $job->hiring_num = $request->hiring_num;
        $job->salary_id = $request->salary_range;
        $job->description = $request->description;
        $job->level_id = $request->level;
        $job->experience = $request->experience;
        $job->gender_id = $request->gender;
        $job->start_age = $request->startAge;
        $job->end_age = $request->endAge;
        $job->requirements = $request->requirements;
        $job->employer_id = $request->employer;
        $job->save();

        $educationDetail = Educations_Detail::where('job_id', $job->id)->first();
        if ($educationDetail) {
            if ($request->education) {
                $educationDetail->education_id = $request->education;
            }
            if ($request->education) {
                $educationDetail->education_id = $request->education;
            }
            if ($request->studyfield) {
                $educationDetail->field_of_study = $request->studyfield;
            }
            $educationDetail->save();
        }
        // $job->jobLocations()->delete();
        // foreach ($request->province as $index => $province_id) {
        //     $job->jobLocations()->create([
        //         'province_id' => $province_id,
        //         'district_id' => $request->district[$index],
        //     ]);
        // }
        $jobLocation = JobLocation::where('job_id', $job->id)->first();
        if ($jobLocation) {
            $locationDetails = LocationWorking::where('id', $jobLocation->location_id)->first();
            if ($locationDetails) {
                $locationDetails->province_id = $request->province[0];
                $locationDetails->district_id = $request->district[0];
                if (isset($request->detail[0])) {
                    $locationDetails->desc = $request->detail[0];
                }
                $locationDetails->save();
            }
        }
        $jobLangDetails = JobLang::where('job_id', $job->id)->first();
        // dd($jobLangDetails);
        $langDetail = Lang_Details::where('id', $jobLangDetails->lang_skill_id)->first();
        if ($langDetail) {
            if (isset($request->languages[0])) {
                $langDetail->lang_id = $request->languages[0];
            }
            if (isset($request->Lang_skill[0])) {
                $langDetail->skill_id = $request->Lang_skill[0];
            }
            $langDetail->save();
        }

        return redirect()->route('job')->with('success', 'Job updated successfully.');
    }
    public function copy($id)
    {
        $job = Job::findOrFail($id);

        // Create a new job with the same data
        $newJob = $job->replicate();
        $newJob->posted_at = now();
        $newJob->status = 'online';
        $newJob->save();

        // Copy education details
        $educationDetail = Educations_Detail::where('job_id', $job->id)->first();
        if ($educationDetail) {
            $newEducationDetail = $educationDetail->replicate();
            $newEducationDetail->job_id = $newJob->id;
            $newEducationDetail->save();
        }

        // Copy job locations
        $jobLocations = JobLocation::where('job_id', $job->id)->first();
        $jobLangDetails = LocationWorking::where('id', $jobLocations->location_id)->first();
        if ($jobLocations) {
            if ($jobLangDetails) {
                $newJobLangDetails = $jobLangDetails->replicate();
                $newJobLangDetails->save();
            }
            $newJobLocation = $jobLocations->replicate();
            $newJobLocation->job_id = $newJob->id;
            $newJobLocation->location_id = $newJobLangDetails->id;
            $newJobLocation->save();
        }




        // Copy job languages and skills
        $jobLangs = JobLang::where('job_id', $job->id)->get();
        foreach ($jobLangs as $jobLang) {
            $newJobLang = $jobLang->replicate();
            $newJobLang->job_id = $newJob->id;
            $newJobLang->save();
        }
        if ($newJob) {
            return redirect()->route('edit_job', $newJob->id);
        }
    }
    // public function destroy($id)
    // {
    //     $job = Job::findOrFail($id);
    //     $educationDetail = Educations_Detail::where('job_id', $job->id)->first();
    //     if ($educationDetail) {
    //         $educationDetail->delete();
    //     }


    //     $jobLang = JobLang::where('job_id', $job->id)->first();
    //     $langDetail = Lang_Details::where('id', $jobLang->lang_skill_id)->first();

    //     $location = JobLocation::where('job_id', $job->id)->first();
    //     $locationDetail = LocationWorking::where('id', $location->location_id)->first();

    //     $locationDetail->delete();
    //     $langDetail->delete();



    //     $job->delete();

    //     return redirect()->route('job')->with('success', 'Job deleted successfully.');
    // }
    public function destroy($id)
{
    // Find the job to be deleted
    $job = Job::findOrFail($id);

    // Delete related job_lang_skill records
    $jobLangSkills = JobLang::where('job_id', $job->id)->get();
    foreach ($jobLangSkills as $jobLangSkill) {
        // Delete related language_skills records
        language::where('id', $jobLangSkill->lang_skill_id)->delete();
    }
    JobLang::where('job_id', $job->id)->delete();

    // Delete related job_location records
    $jobLocations = JobLocation::where('job_id', $job->id)->get();
    foreach ($jobLocations as $jobLocation) {
        // Delete related locations records
        Location::where('id', $jobLocation->location_id)->delete();
    }
    JobLocation::where('job_id', $job->id)->delete();

    // Delete the job itself
    $job->delete();

    return redirect()->route('job')->with('success', 'Job deleted successfully.');
}
}
