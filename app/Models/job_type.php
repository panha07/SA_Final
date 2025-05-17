<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class job_type extends Model
{
    protected $table = "job_type";

    protected $fillable=[
        'id',
        'name',
        'status'
    ];
}
