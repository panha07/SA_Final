<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    protected $table = "level";
    protected $fillable=([
     "id",
     "level",
     "status",
    ]);
}
