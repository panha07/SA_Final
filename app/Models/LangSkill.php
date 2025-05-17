<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LangSkill extends Model
{
  protected $table = 'language_skills';
  protected $fillable = ['id','skill_id', 'lang_id'];
  
  public function language()
  {
      return $this->belongsTo(Language::class, 'lang_id');
  }

  public function skill()
  {
      return $this->belongsTo(SkillLang::class, 'skill_id');
  }
    // public function jobLang()
    // {
    //     return $this->hasMany(JobLang::class, 'lang_skill_id');
    // }

}
