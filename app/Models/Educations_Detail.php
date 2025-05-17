<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Educations_Detail extends Model
{
   protected $table = 'education_detail';
   protected $fillable = [
       'id',
       'job_id',
       'education_id',
       'field_of_study',];
       public function educations()
       {
           return $this->belongsTo(educations::class, 'education_id');
       }
      
}
