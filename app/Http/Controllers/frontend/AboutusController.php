<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    public function index()
    {
        return view("frontend.about.index");
    }
    
   
    
}
