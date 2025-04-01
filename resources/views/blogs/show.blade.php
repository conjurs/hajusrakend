@extends('layouts.app')

@section('title', $blog->title . ' - Blogs - Hajusrakendused')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>{{ $blog->title }}</h1>
        <p class="text-muted">
            <small>Posted {{ $blog->created_at->diffForHumans() }}</small>
        </p>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('blogs.index') }}" class="btn btn-outline-cyan">
            <i class="bi bi-arrow-left"></i> Back to Blogs
        </a>
        <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-outline-cyan">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                <i class="bi bi-trash"></i> Delete
            </button>
        </form>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="blog-content">
                    {{ $blog->description }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <h3>Comments ({{ $comments->count() }})</h3>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add a Comment</h5>
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                    <div class="mb-3">
                        <textarea class="form-control bg-custom-dark text-white border-secondary @error('content') is-invalid @enderror" id="content" name="content" rows="3" required>{{ old('content') }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-cyan">Submit Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @forelse($comments as $comment)
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="text-muted mb-2">
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                    </p>
                    <div>
                        <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-outline-cyan me-1">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
                <p class="mb-0">{{ $comment->content }}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info">
            No comments yet. Be the first to comment!
        </div>
    </div>
    @endforelse
</div>
@endsection 