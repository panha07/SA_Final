<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\employers;
use App\Models\Job;
use App\Models\job_categories;
use App\Models\post_jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class HomeController extends Controller
{
    public function index(){
    

        $jobCategories = job_categories::withCount(['jobs' => function ($query) {
            $query->where('status', 'online');
        }])->where('status', '1')->get();
        $jobs = Job::with('jobLocations.location.province', 'jobLocations.location.district', 'salary', 'jobType')
            ->where('status', 'online')
            ->orderBy('created_at', 'desc')
            ->limit(5)->get();
        
        $noData = $jobCategories->isEmpty();    
    return view("frontend.home", compact('jobCategories','jobs','noData'));
    }
    
    
}
