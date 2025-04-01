@extends('layouts.app')

@section('title', 'Create Blog - Hajusrakendused')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Create New Blog</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Blogs
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('blogs.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Content</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10" required>{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Create Blog</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 