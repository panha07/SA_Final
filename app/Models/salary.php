<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class salary extends Model
{
    protected $table = "salary";
    protected $fillable=[
        'id',
        'salary_rank',
        
    ];
}
