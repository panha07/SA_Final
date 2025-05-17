<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lang_Details extends Model
{
  protected $table = 'language_skills';
  protected $fillable = ['id', 'skill_id', 'lang_id', ];
  
    public function language()
    {
        return $this->hasMany(language::class, 'id');
    }
   
    public function langSkill()
    {
        return $this->hasMany(LangSkill::class, 'id');
    }
    public function jobLang()
    {
        return $this->hasMany(JobLang::class, 'lang_skill_id');
    }
    
    
}
