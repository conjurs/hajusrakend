@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h1>Admin Dashboard</h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Blogs</h5>
                <p class="card-text display-4">{{ $stats['total_blogs'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Comments</h5>
                <p class="card-text display-4">{{ $stats['total_comments'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text display-4">{{ $stats['total_users'] }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">User Management</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats['users'] as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->isAdmin())
                                        <span class="badge bg-primary">Admin</span>
                                    @elseif($user->isBanned())
                                        <span class="badge bg-danger">Banned</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$user->isAdmin())
                                        @if($user->isBanned())
                                            <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="bi bi-check-circle"></i> Unban
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.ban', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-x-circle"></i> Ban
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $stats['users']->links() }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Blogs</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($stats['recent_blogs'] as $blog)
                    <div class="list-group-item bg-custom-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-1">{{ $blog->title }}</h6>
                            <small>{{ $blog->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1">By {{ $blog->user->name }}</p>
                        <div class="btn-group">
                            <a href="{{ route('blogs.show', $blog) }}" class="btn btn-sm btn-outline-cyan">View</a>
                            @can('delete', $blog)
                                <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Comments</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($stats['recent_comments'] as $comment)
                    <div class="list-group-item bg-custom-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-1">On {{ $comment->blog->title }}</h6>
                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1">{{ $comment->content }}</p>
                        <small>By {{ $comment->user->name }}</small>
                        @can('delete', $comment)
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 