@extends('layouts.app')

@section('content')
<div class="hero-section text-center py-5">
    <!-- Add floating emojis container -->
    <div class="floating-emojis-container">
        <div class="emoji emoji-frog">🐸</div>
        <div class="emoji emoji-love">❤️</div>
        <div class="emoji emoji-lol">
            <div style="background-color: #FFCC00; border-radius: 50%; padding: 10px 20px; font-weight: bold; font-size: 24px; color: #FF3333;">LOL</div>
        </div>
        <div class="emoji emoji-fire">🔥</div>
        <div class="emoji emoji-party">🎉</div>
        <div class="emoji emoji-frog">🐸</div>
        <div class="emoji emoji-love">❤️</div>
        <div class="emoji emoji-fire">🔥</div>
    </div>
    
    <div class="container">
        <h1 class="display-3 fw-bold mb-4">Endless Memes for Every Occasion</h1>
        <p class="lead mb-5">Discover and share the best memes on the internet, all in one place.</p>
        
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="search-container mb-5">
                    <form action="{{ route('home') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control form-control-lg search-input" 
                            placeholder="Search memes" aria-label="Search">
                        <button class="btn btn-primary btn-lg ms-2 px-4" type="submit">Search</button>
                    </form>
                </div>
                
                <a href="{{ route('memes.feed') }}" class="btn btn-primary btn-lg px-4 py-2">Browse</a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="mb-4">Trending Memes</h2>
    <div class="row">
        @forelse($memes as $meme)
        <div class="col-md-4 mb-4">
            <div class="card meme-card shadow-sm h-100">
                <div class="card-img-top">
                @if($meme->type == 'image')
                    <a href="{{ route('memes.show', $meme) }}">
                        <img src="{{ $meme->content_url }}" class="img-fluid rounded-top" alt="{{ $meme->title }}">
                    </a>
                    @else
                    <div class="video-container">
                        @if($meme->source == 'instagram')
                        <blockquote class="instagram-media" data-instgrm-permalink="{{ $meme->content_url }}" data-instgrm-version="14"></blockquote>
                        @elseif($meme->source == 'tiktok')
                        <blockquote class="tiktok-embed" cite="{{ $meme->content_url }}"></blockquote>
                        @else
                        <video controls class="w-100">
                            <source src="{{ $meme->content_url }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('memes.show', $meme) }}" class="text-decoration-none">{{ $meme->title }}</a>
                    </h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">By 
                            <a href="{{ route('user.profile', $meme->user) }}" class="text-decoration-none">
                                {{ $meme->user->name }}
                            </a>
                        </small>
                        <div>
                            <small class="text-muted me-2">
                                <i class="fas fa-eye"></i> {{ $meme->views }}
                            </small>
                            <small class="text-muted">
                                <i class="fas fa-heart"></i> {{ $meme->likes }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <form action="{{ route('memes.like', $meme) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                            <i class="fas fa-heart"></i> Like
                        </button>
                    </form>
                    @if(Auth::check() && Auth::id() === $meme->user_id)
                    <a href="{{ route('memes.edit', $meme) }}" class="btn btn-sm btn-outline-secondary border-0">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('memes.destroy', $meme) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this meme?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                @endif
                </div>
            </div>
            </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> No memes found. Be the first to post a meme!
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $memes->links() }}
    </div>
</div>

@if($memes->where('source', 'instagram')->count() > 0)
<script async defer src="//www.instagram.com/embed.js"></script>
@endif

@if($memes->where('source', 'tiktok')->count() > 0)
<script async defer src="https://www.tiktok.com/embed.js"></script>
@endif

<style>
.hero-section {
    min-height: 70vh;
    display: flex;
    align-items: center;
    background-color: #ffffff;
    position: relative;
    overflow: hidden;
}

.hero-section:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23f0f0f0' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");
    opacity: 0.5;
    z-index: 0;
}

.hero-section .container {
    position: relative;
    z-index: 1;
}

.search-container {
    position: relative;
    z-index: 2;
}

.search-input {
    border-radius: 30px 0 0 30px;
    height: 56px;
}

.search-container .btn {
    border-radius: 0 30px 30px 0;
}

@media (max-width: 768px) {
    .hero-section {
        min-height: 50vh;
    }
    
    .emoji {
        transform: scale(0.7);
    }
}
</style>
@endsection 