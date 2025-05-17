<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\employers;
use App\Models\Job;
use App\Models\job_categories;
use App\Models\job_type;
use App\Models\JobLang;
use App\Models\Lang_Details;
use App\Models\LangSkill;
use App\Models\language;
use App\Models\province;
use App\Models\SkillLang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index(Request $request)
    {
        
        // $totalJobs = Job::where('status', 'online')->count();
        $job_categories=job_categories::where('status', '1')->get();
        $job_types = job_type::where('status', '1')->get();
        $provinces= province::select('id','province')->get();

        $query = Job::with('jobLocations.location.province', 'jobLocations.location.district', 'salary', 'jobType')
        ->where('status', 'online');
        if ($request->has('category') && $request->category != '') {
            $query->where('job_categories_id', $request->category);
        }

        if ($request->has('job_types') && is_array($request->job_types) && count($request->job_types) > 0) {
            $query->whereIn('job_type_id', $request->job_types);
        }
        if ($request->has('province') && $request->province != '') {
            $query->whereHas('jobLocations.location.province', function ($q) use ($request) {
                $q->where('id', $request->province);
            });
        }
         if ($request->has('experience') && $request->experience != '') {
            $query->where('experience', '>=', $request->experience);
        }
        if ($request->has('sort_by') && $request->sort_by != '') {
            switch ($request->sort_by) {
                case 'title':
                    $query->orderBy('title', 'asc');
                    break;
                case 'category':
                    $query->orderBy('job_categories_id', 'asc');
                    break;
                case 'experience':
                    $query->orderBy('experience', 'asc');
                    break;
                default:
                    $query->orderBy('posted_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('posted_at', 'asc');
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $totalJobs = $query->count();
        $jobs = $query->orderBy('created_at', 'desc')->paginate(6);
        return view('frontend.job.index', compact('jobs','totalJobs','job_categories','job_types','provinces'));
    }
    public function show($id)
    {
    //    dd($id);
            $job = Job::with('jobLocations.location.province', 'jobLocations.location.district','jobLangSkills.langDetails.language' ,'jobLangSkills.langDetails.langSkill','salary', 'jobType')
            ->where('status', 'online')
            ->findOrFail($id);
           $employer=employers::where('id',$job->employer_id)->first();
        
           $jobLangSkills=JobLang::where('job_id',$job->id)->first();
          
          $langDetial=Lang_Details::where('id',$jobLangSkills->lang_skill_id)->first();
          
           $lang = language::select('lang')->where('id',$langDetial->lang_id)->first();
           $skill =SkillLang::select('skill')->where('id',$langDetial->skill_id)->first();
         
           
            // dd($job);
        return view('frontend.job.showJobDetails', compact('job','employer','lang','skill'));
    }

}
 