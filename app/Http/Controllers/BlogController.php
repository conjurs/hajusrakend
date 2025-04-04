<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('blogs.index', compact('blogs'));
    }


    public function create()
    {
        return view('blogs.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        
        Blog::create($validated);
        
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully');
    }


    public function show(Blog $blog)
    {
        $comments = $blog->comments()->latest()->get();
        return view('blogs.show', compact('blog', 'comments'));
    }


    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }


    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        
        $blog->update($validated);
        
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }

 
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
}
