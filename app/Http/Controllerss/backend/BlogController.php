<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $status = $request->input('status', 1);
    $blogs = Blog::with('user')
        ->where('status', $status)
        ->when($search, function ($query, $search) {
            $query->where('blog_title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        })
        ->paginate(6); 

    return view('backend.Blog.index', compact('blogs'));
}
    public function add_blog()
    {
        $generate_id = time() . '_' . uniqid();
        return view('backend.Blog.add_blog',compact('generate_id'));
    }
    public function store_add_blog(Request $request)
    {
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'status' => 'required|in:0,1',
        ]);
        $current_user  = Auth::user()->id;
        $blog = new Blog();
        $blog->blog_title = $validated['title'];
        $blog->description = $validated['description'];
        $blog->user_id = $current_user;
        $blog->status = $validated['status'];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = public_path('assets/img/blog');
            $image->move($path, $filename);
            $blog->img = $filename;
        }
        $blog->save();
        return redirect()->route('add_blog')->with('success', 'Blog added successfully!');
    }
    public function edit($id)
    {
        $blog = Blog::findOrFail($id); 
        return view('backend.Blog.edit_blog', compact('blog')); 
    }
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);
  
        $blog->blog_title = $validated['title'];
        $blog->description = $validated['description'];
        $blog->status=$validated['status'];
        if ($request->hasFile('image')) {
            if ($blog->img && file_exists(public_path('assets/img/blog/' . $blog->img))) {
                unlink(public_path('assets/img/blog/' . $blog->img)); 
            }
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = public_path('assets/img/blog');
            $image->move($path, $filename);
            $blog->img = $filename;
        }

        $blog->save();

        return redirect()->route('blog')->with('success', 'Blog updated successfully!');
    }
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->img && file_exists(public_path('assets/img/blog/' . $blog->img))) {
            unlink(public_path('assets/img/blog/' . $blog->img)); 
        }
        $blog->delete();

        
        return redirect()->route('blog')->with('success', 'Blog deleted successfully!');
    }
}
