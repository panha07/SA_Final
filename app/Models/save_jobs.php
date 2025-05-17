<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class save_jobs extends Model
{
    protected $fillable = [
        'id',
        'job_seeker_id',
        'job_id',
    ];
}
