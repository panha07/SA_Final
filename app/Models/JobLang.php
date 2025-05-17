<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobLang extends Model
{
    protected $table = 'job_lang_skill';
    protected $fillable = ['lang_skill_id', 'job_id'];
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
    public function langSkill()
    {
        return $this->belongsTo(LangSkill::class, 'lang_skill_id');
    }
    public function langDetails()
    {
        return $this->belongsTo(Lang_Details::class, 'id');
    }
}
