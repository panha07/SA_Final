<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class education extends Model
{
    protected $table="education";
    protected $fillable=[
        "id",
        "name_id",
        "field_of_study",

    ];

}
