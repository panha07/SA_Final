<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user')
            ->orderby('updated_at')
            ->get();
        $com_ac=$blogs->where('status',1);
       
        return view("frontend.Blog.Company_Active.index", compact('com_ac'));
    }
    public function csr()
    {
        $blogs = Blog::with('user')
            ->orderby('updated_at')
            ->get();
       
        $csr=$blogs->where('status',0);
      
        return view("frontend.Blog.CSR.index", compact('csr'));
    }

    public function blog_detail($id,$status)
    {
        
        $blog = Blog::with('user')->findOrFail($id);
    
        $blogs = Blog::with('user')
            ->orderby('updated_at')
            ->where('id', '!=', $id)
            ->where('status',$status)
            ->paginate(6);


        return view('frontend.Blog.blog_detail', compact('blog', 'blogs'));
    }
}
