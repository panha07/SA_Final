<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $tablename='blogs';
    protected $fillable=[
        'id',
        'blog_title',
        'descriptions',
        'img',
        'user_id'
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

   }

