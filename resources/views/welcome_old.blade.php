@extends('layouts.app')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="display-4 fw-bold mb-4">Endless Memes for Every Occasion</h1>
                <p class="lead mb-5">Discover and share the best memes on the internet, all in one place.</p>
                
                <div class="search-container mb-4">
                    <form action="{{ route('home') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="search-input" 
                            placeholder="Search memes" aria-label="Search">
                        <button class="search-button" type="submit">
                            <i class="fas fa-search me-2"></i> Search
                        </button>
                    </form>
                </div>
                
                <div class="d-flex gap-3">
                    <a href="{{ route('memes.feed') }}" class="btn btn-light btn-lg px-4">Browse</a>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">Join Now</a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://placehold.co/600x400/FF4433/FFFFFF/png?text=MemeHub" alt="MemeHub" class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute" style="top: -20px; right: -20px; font-size: 5rem;">🤣</div>
                    <div class="position-absolute" style="bottom: -15px; left: -15px; font-size: 4rem;">👍</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-6 mx-auto text-center">
            <h2 class="fw-bold mb-4">Why Choose MemeHub?</h2>
            <p class="lead">The ultimate platform for meme lovers to discover, share, and create content.</p>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="feature-icon mb-3">
                        <span style="font-size: 3rem;">🔍</span>
                    </div>
                    <h4 class="card-title">Discover</h4>
                    <p class="card-text">Find trending memes across different categories tailored to your interests.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="feature-icon mb-3">
                        <span style="font-size: 3rem;">🚀</span>
                    </div>
                    <h4 class="card-title">Share</h4>
                    <p class="card-text">Easily share your favorite memes with friends across social media platforms.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="feature-icon mb-3">
                        <span style="font-size: 3rem;">✨</span>
                    </div>
                    <h4 class="card-title">Create</h4>
                    <p class="card-text">Use our easy tools to create your own viral memes in seconds.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-light py-5 my-5 rounded-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4">Trending Memes</h2>
                <p class="lead mb-4">Check out what's popular right now on MemeHub</p>
                <a href="{{ route('memes.feed') }}" class="btn btn-primary btn-lg px-4">See All Trending</a>
            </div>
            
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="card meme-card h-100">
                            <img src="https://placehold.co/300x200/FF7B54/FFFFFF/png?text=Trending+Meme" class="card-img-top" alt="Trending Meme">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card meme-card h-100">
                            <img src="https://placehold.co/300x200/6C63FF/FFFFFF/png?text=Popular+Meme" class="card-img-top" alt="Popular Meme">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card meme-card h-100">
                            <img src="https://placehold.co/300x200/FFD166/333333/png?text=Viral+Meme" class="card-img-top" alt="Viral Meme">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card meme-card h-100">
                            <img src="https://placehold.co/300x200/06D6A0/FFFFFF/png?text=Funny+Meme" class="card-img-top" alt="Funny Meme">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-6 mx-auto text-center">
            <h2 class="fw-bold mb-4">Join Our Community</h2>
            <p class="lead mb-4">Connect with thousands of meme enthusiasts and creators</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 py-3">Create Account</a>
            @else
                <a href="{{ route('memes.create') }}" class="btn btn-primary btn-lg px-4 py-3">Create Your First Meme</a>
            @endguest
        </div>
    </div>
</div>
@endsection 