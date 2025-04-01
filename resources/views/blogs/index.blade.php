@extends('layouts.app')

@section('title', 'Blogs - Hajusrakendused')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Blogs</h1>
        <p>View our latest blog posts and join the discussion!</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('blogs.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Create New Blog
        </a>
    </div>
</div>

<div class="row">
    @forelse($blogs as $blog)
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">{{ $blog->title }}</h5>
                <p class="card-text text-muted">
                    <small>Posted {{ $blog->created_at->diffForHumans() }}</small>
                    <small class="ms-2">
                        <i class="bi bi-chat-left-text"></i> {{ $blog->comments->count() }} Comments
                    </small>
                </p>
                <p class="card-text">{{ \Illuminate\Support\Str::limit($blog->description, 150) }}</p>
                <a href="{{ route('blogs.show', $blog) }}" class="btn btn-primary">Read More</a>
            </div>
            <div class="card-footer bg-transparent d-flex justify-content-end">
                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info">
            No blogs found. <a href="{{ route('blogs.create') }}">Create the first blog!</a>
        </div>
    </div>
    @endforelse
</div>

<div class="row">
    <div class="col-12">
        {{ $blogs->links() }}
    </div>
</div>
@endsection 