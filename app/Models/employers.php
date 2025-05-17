<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employers extends Model
{
    protected $fillable = [
        'company_profile_id',
        'name',
        'department',
        'position',
        'phone',
        'email',
       
    ];
    public function companyProfile()
    {
        return $this->belongsTo(company_profile::class);
    }
    
   
    
}
