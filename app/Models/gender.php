<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gender extends Model
{
    protected $table="gender";
    protected $fillable=[
        "id",
        "gender",
        "status",
    ];
}
