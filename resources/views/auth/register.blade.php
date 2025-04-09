@extends('layouts.app')

@section('title', 'Register - Hajusrakendused')

@section('styles')
<style>
    .auth-container {
        max-width: 500px;
        margin: 3rem auto;
        padding: 0 1rem;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.5rem;
    }

    .auth-subtitle {
        color: #666;
        font-size: 1rem;
    }

    .form-container {
        background: rgba(20, 20, 20, 0.4);
        border-radius: 8px;
        overflow: hidden;
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.75rem;
        font-weight: 600;
        color: #fff;
    }

    .form-control {
        width: 100%;
        background: rgba(40, 40, 40, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        padding: 0.75rem 1rem;
        color: #fff;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: rgba(0, 200, 227, 0.4);
        box-shadow: 0 0 0 2px rgba(0, 200, 227, 0.1);
    }

    .form-error {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .form-actions {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1rem;
    }

    .btn {
        width: 100%;
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-submit {
        background: rgb(0, 200, 227);
        color: #000;
    }

    .btn-submit:hover {
        background: rgb(0, 220, 247);
    }

    .auth-footer {
        text-align: center;
        margin-top: 2rem;
    }

    .auth-footer-text {
        color: #666;
        font-size: 0.9rem;
    }

    .auth-footer-link {
        color: rgb(0, 200, 227);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .auth-footer-link:hover {
        color: rgb(0, 220, 247);
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-header">
        <h1 class="auth-title">Register</h1>
        <p class="auth-subtitle">Create a new account</p>
    </div>

    <div class="form-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Username</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-person-plus-fill"></i> Register
                </button>
            </div>
        </form>
    </div>

    <div class="auth-footer">
        <p class="auth-footer-text">
            Already have an account? <a href="{{ route('login') }}" class="auth-footer-link">Login</a>
        </p>
    </div>
</div>
@endsection 