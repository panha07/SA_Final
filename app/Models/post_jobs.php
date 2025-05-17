<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class post_jobs extends Model
{
    protected $table = 'post_jobs';
    protected $fillable = [
        'id',
        'employer_id',
        'location_id',
        'lang_id',
        'employer_id',
        'title',
        'salary_id',
        'job_type_id',
        'experience',
        'level_id',
        'created_at',
        'posted_at' ,
        
        
    
    ];
    protected $casts = [
        'posted_at' => 'datetime',
    ];
   
    public function jobCategory()
    {
        return $this->belongsTo(job_categories::class, 'job_categories_id');
    }
    public function employer()
    {
        return $this->belongsTo(employers::class,);
    }
    // public static function getJobsWithCompanyDetails()
    // {
    //     return self::with(['employer.companyProfile'])
    //         ->select('title','level_id','experience', 'salary_id', 'job_type_id',
    //          'location_id', 'posted_at','company_profiles.name', 'company_profiles.logo')
    //         // ->join('employers', 'post_jobs.employer_id', '=', 'employers.id')
    //         ->join('company_profiles', 'employers.company_profile_id', '=', 'company_profiles.id');
    // }
    
}
