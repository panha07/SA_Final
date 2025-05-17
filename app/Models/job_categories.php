<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class job_categories extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
        'icon',
        'status',
        'status',
        'job_id',
        
        
    
    ];
    public function jobs()
    {
        return $this->hasMany(Job::class, 'job_categories_id');
    }

    public function activeJobs()
    {
        return $this->hasMany(post_jobs::class, 'job_categories_id')->where('status', '1');
    }
}
