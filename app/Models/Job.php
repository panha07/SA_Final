<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'post_jobs';

    protected $fillable = [
        'id',
        'title',
        'posted_at',
        'job_type_id',
        'job_categories_id',
        'location_id',
        'hiring_num',
        'salary_id',
        'description',
        'level_id',
        'education_id',
        'experience',
        'lang_id',
        'gender_id',
        'start_age',
        'end_age',
        'requirements',
        'application_deadline',
        'company_profile_id',
        'active',
        'status',
    ];
    public function jobLocations()
    {
        return $this->hasMany(JobLocation::class, 'job_id');
    }
    public function jobLangSkills()
    {
        return $this->hasMany(JobLang::class, 'job_id');
    }
    public function salary()
    {
        return $this->belongsTo(salary::class, 'salary_id');
    }
    public function jobType()
    {
        return $this->belongsTo(job_type::class, 'job_type_id');
    }
    public function levels()
    {
        return $this->belongsTo(level::class, 'level_id');
    }
    public function jobCategories()
    {
        return $this->belongsTo(job_categories::class, 'job_categories_id');
    }
    public function educations_Detail()
    {
        return $this->belongsTo(Educations_Detail::class, 'education_id');
    }
}
