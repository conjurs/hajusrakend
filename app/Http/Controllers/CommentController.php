<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::with('blog')->latest()->paginate(20);
        return view('comments.index', compact('comments'));
    }


    public function create()
    {
        $blogs = Blog::all();
        return view('comments.create', compact('blogs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'content' => 'required|string',
        ]);
        
        Comment::create($validated);
        
        return redirect()->route('blogs.show', $validated['blog_id'])->with('success', 'Comment added successfully');
    }

    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    public function edit(Comment $comment)
    {
        $blogs = Blog::all();
        return view('comments.edit', compact('comment', 'blogs'));
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        
        $comment->update($validated);
        
        return redirect()->route('blogs.show', $comment->blog_id)->with('success', 'Comment updated successfully');
    }

    public function destroy(Comment $comment)
    {
        $blogId = $comment->blog_id;
        $comment->delete();
        return redirect()->route('blogs.show', $blogId)->with('success', 'Comment deleted successfully');
    }
}
