<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\company_profile;
use App\Models\districts;
use App\Models\educations;
use App\Models\employers;
use App\Models\gender;
use App\Models\job_categories;
use App\Models\job_type;
use App\Models\jobs;
use App\Models\language;
use App\Models\level;
use App\Models\Location;
use App\Models\post_jobs;
use App\Models\province;
use App\Models\salary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view("backend.Home.index");
    }
    public function post_job(Request $req)
    {
        dd($req->all());
        // $validator = Validator::make($req->all(), [
        //     'title' => 'required|string|max:255',
        //     'posted_at' => 'required|date|after_or_equal:today',
        //     'job_type' => 'required|integer',
        //     'job_categories' => 'required|integer',
        //     'province' => 'required|integer',
        //     'district' => 'required|integer',
        //     'hiring_num' => 'required|integer|min:1',
        //     'studyfield' => 'required|string|max:255',
        //     'experience' => 'required|integer|min:0|max:50',
        //     'lang' => 'required|string',
        //     'Lang_skill' => 'required|string',
        //     'gender' => 'required|string',
        //     'startAge' => 'required|integer|min:10',
        //     'endAge' => 'required|integer|gte:startAge|max:70',
        //     'requirements' => 'required|string',
        //     'employers' => 'required|string',
        // ], [
        //     'title.required' => 'The Position Title field is required.',
        //     'posted_at.required' => 'The Publish Date field is required.',
        //     'posted_at.after_or_equal' => 'The Publish Date must be a date after or equal to today.',
        //     'job_type.required' => 'Please select the Position Nature.',
        //     'job_categories.required' => 'Please select a Job Category.',
        //     'province.required' => 'Please select a Province.',
        //     'district.required' => 'Please select a District.',
        //     'hiring_num.min' => 'At least one hiring position is required.',
        //     'endAge.gte' => 'End Age must be greater than or equal to Start Age.',
        //     'requirements.required' => 'Please specify the job requirements.',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }
        // $job = new post_jobs();
        // $job->title = $req->title;
        // $job->posted_at = $req->posted_at;
        // $job->job_type_id = $req->job_type;
        // $job->job_category_id = $req->job_categories;
        // $job->province_id = $req->province;
        // $job->district_id = $req->district;
        // $job->hiring_num = $req->hiring_num;
        // $job->studyfield = $req->studyfield;
        // $job->experience = $req->experience;
        // $job->lang = $req->lang;
        // $job->Lang_skill = $req->Lang_skill;
        // $job->gender = $req->gender;
        // $job->startAge = $req->startAge;
        // $job->endAge = $req->endAge;
        // $job->requirements = $req->requirements;
        // $job->employers = $req->employers;
        // $job->user_id = Auth::user()->id; 
        return redirect()->route('post_job')->with('success', 'Job posted successfully!');

        // return response()->json(['success' => 'Job posted successfully!']);
    }
    public function add_job()
    {

        $provinces = province::select('id', 'province')->get();
        $jobCategory = job_categories::select('id', 'name')->get();
        $jobType = job_type::select("id", 'name')->where('status', 1)->get();
        $level = level::select("id", 'level')->where('status', 1)->get();
        $salary = salary::select("id", 'salary_rank')->get();
        $educations = educations::select("id", 'education')->get();
        $language = language::select("id", 'lang')->get();
        $language_skill = DB::table('skills')->select('id', 'skill')->get();
        $gender = gender::select("id", "gender")->where("status", 1)->get();

        $current_user = Auth::user()->id;




        // Auth::user()->companyProfile;

        $employers = employers::join('company_profiles', 'employers.company_profile_id', '=', 'company_profiles.id')
            ->select(
                'employers.id',
                'employers.name as user_name',
                'employers.phone',
                'employers.department',
                'employers.position',
                'employers.email',
                'company_profiles.name',
                'company_profiles.logo',
                'company_profiles.address as company_address',
                'company_profiles.website as company_website',
            )
            ->where('company_profiles.user_id', $current_user)

            ->get();
        // dd($employers);



        return view(
            'backend.Home.add_job',
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
    public function fectEmployerContact(Request $req)
    {
        // Validate the incoming request
        $req->validate([
            'id' => 'required|exists:employers,id'
        ]);

        // Fetch employer data
        $employer = employers::find($req->id);

        if ($employer) {
            return response()->json($employer);
        } else {
            return response()->json(['error' => 'Employer not found'], 404);
        }
    }


    public function fetchDistricts(Request $request)
    {
        $provinceId = $request->province_id;
        $districts = districts::where('province_id', $provinceId)->get();
        return response()->json($districts);
    }
    // public function fetchDistricts(Request $req)
    // {
    //     dd($req->all());
    //     $districts = districts::where('province_id', $req->)->get(['id', 'name']);
    // return response()->json($districts);

    // }
}
