@extends('layouts.app')

@section('title', 'Home - Hajusrakendused')

@section('styles')
<style>
    .home-container {
        min-height: 80vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        position: relative;
    }
    
    .home-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center, #1e1e1e 0%, #121212 100%);
        z-index: -1;
    }
    
    .home-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        background: linear-gradient(90deg, var(--primary-color), #00f0ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 0 10px rgba(0, 200, 227, 0.3);
    }
    
    .home-subtitle {
        font-size: 1.5rem;
        margin-bottom: 4rem;
        color: #aaa;
        font-weight: 300;
    }
    
    .features-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2.5rem;
        margin-top: 2rem;
        perspective: 1000px;
    }
    
    .feature-btn {
        position: relative;
        width: 220px;
        height: 220px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        overflow: hidden;
        background-color: rgba(30, 30, 30, 0.7);
        border: none;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        transform-style: preserve-3d;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }
    
    .feature-btn:hover {
        transform: translateY(-15px) rotateX(10deg);
        box-shadow: 0 20px 40px rgba(0, 200, 227, 0.4);
    }
    
    .feature-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent 20%, rgba(0, 200, 227, 0.1) 40%, rgba(0, 200, 227, 0.3) 60%, transparent 80%);
        z-index: 1;
        transform: translateY(100%) rotate(45deg);
        transition: transform 0.7s cubic-bezier(0.23, 1, 0.32, 1);
    }
    
    .feature-btn:hover::before {
        transform: translateY(-100%) rotate(45deg);
    }
    
    .feature-btn.maps {
        background: linear-gradient(135deg, rgba(30, 30, 30, 0.9), rgba(30, 30, 30, 0.7)), url('https://imgs.search.brave.com/r_YpSmuQl-RFXJ9fZy5IMUNKH-Wgca4j8dInA8XNGwY/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pLnBp/bmltZy5jb20vb3Jp/Z2luYWxzLzBkLzMw/LzA2LzBkMzAwNmE3/Mzc1MmUyZDA0MGU5/Y2M1NDYwODg5NGY0/LmpwZw');
        background-size: cover;
        background-position: center;
    }
    
    .feature-btn.blog {
        background: linear-gradient(135deg, rgba(30, 30, 30, 0.9), rgba(30, 30, 30, 0.7)), url('https://imgs.search.brave.com/I10KL_fcpEyJCRSeXwTwMFBlpscVELUQZhUKnorSATM/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pLnBp/bmltZy5jb20vb3Jp/Z2luYWxzL2Y1LzJm/LzNiL2Y1MmYzYjQw/ZDE4MWMyOTIxOTM3/M2NiNDk5ZDRjNDg5/LmpwZw');
        background-size: cover;
        background-position: center;
    }
    
    .feature-btn.shop {
        background: linear-gradient(135deg, rgba(30, 30, 30, 0.9), rgba(30, 30, 30, 0.7)), url('https://imgs.search.brave.com/VnevXyhHS5OPkjvvT4gG2LOySbVGkpq9EanzWLZlOhw/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pLnBp/bmltZy5jb20vb3Jp/Z2luYWxzLzQ2L2Ex/LzhlLzQ2YTE4ZWYw/MjU0ZThjOGZkNzll/ZDA4YzM5NzMzZDkz/LmpwZw');
        background-size: cover;
        background-position: center;
    }
    
    .feature-icon {
        font-size: 5rem;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
        filter: drop-shadow(0 0 8px rgba(0, 200, 227, 0.5));
        transition: all 0.5s ease;
        z-index: 2;
    }
    
    .feature-btn:hover .feature-icon {
        transform: scale(1.2);
        color: #fff;
    }
    
    .feature-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--text-color);
        z-index: 2;
        transition: all 0.5s ease;
        position: relative;
    }
    
    .feature-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        width: 0;
        height: 2px;
        background: var(--primary-color);
        transform: translateX(-50%);
        transition: width 0.5s ease;
    }
    
    .feature-btn:hover .feature-title::after {
        width: 80%;
    }
    
    @media (max-width: 768px) {
        .features-container {
            flex-direction: column;
            gap: 2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="home-container">
    <div class="home-background"></div>
    <h1 class="home-title">Hajusrakendused</h1>
    
    <div class="features-container">
        <a href="{{ route('markers.index') }}" class="feature-btn maps">
            <i class="bi bi-map feature-icon"></i>
            <span class="feature-title">Maps</span>
        </a>
        
        <a href="{{ route('blogs.index') }}" class="feature-btn blog">
            <i class="bi bi-journal-richtext feature-icon"></i>
            <span class="feature-title">Blog</span>
        </a>
        
        <a href="{{ route('products.index') }}" class="feature-btn shop">
            <i class="bi bi-shop feature-icon"></i>
            <span class="feature-title">Shop</span>
        </a>
    </div>
</div>
@endsection 