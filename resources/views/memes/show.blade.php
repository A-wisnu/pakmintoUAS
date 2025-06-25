@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">{{ $meme->title }}</h3>
                    <div>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        @if(Auth::id() === $meme->user_id)
                        <a href="{{ route('memes.edit', $meme) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                @if($meme->type == 'image')
                                <img src="{{ $meme->content_url }}" class="img-fluid rounded" alt="{{ $meme->title }}">
                                @else
                                <div class="video-container rounded">
                                    @if($meme->source == 'instagram')
                                    <blockquote class="instagram-media" data-instgrm-permalink="{{ $meme->content_url }}" data-instgrm-version="14" style="min-width: 100%"></blockquote>
                                    @elseif($meme->source == 'tiktok')
                                    <blockquote class="tiktok-embed" cite="{{ $meme->content_url }}" style="min-width: 100%"></blockquote>
                                    @else
                                    <video controls class="w-100 rounded">
                                        <source src="{{ $meme->content_url }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    @endif
                                </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <form action="{{ route('memes.like', $meme) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-heart me-1"></i> Like ({{ $meme->likes }})
                                        </button>
                                    </form>
                                </div>
                                
                                <div>
                                    <span class="badge bg-secondary me-2">
                                        <i class="fas fa-eye me-1"></i> {{ $meme->views }} views
                                    </span>
                                    <span class="badge bg-info">
                                        {{ ucfirst($meme->type) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Posted By</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $meme->user->profile->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($meme->user->name) . '&background=random' }}" 
                                            class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;" 
                                            alt="{{ $meme->user->name }}">
                                        <div>
                                            <h6 class="mb-0">
                                                <a href="{{ route('user.profile', $meme->user) }}" class="text-decoration-none">
                                                    {{ $meme->user->name }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">
                                                {{ $meme->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Source</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        <i class="fas fa-link me-1"></i>
                                        @if($meme->source == 'upload')
                                            Uploaded Content
                                        @elseif($meme->source == 'instagram')
                                            <a href="{{ $meme->content_url }}" target="_blank" rel="noopener">
                                                Instagram Post <i class="fas fa-external-link-alt ms-1"></i>
                                            </a>
                                        @elseif($meme->source == 'tiktok')
                                            <a href="{{ $meme->content_url }}" target="_blank" rel="noopener">
                                                TikTok Post <i class="fas fa-external-link-alt ms-1"></i>
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($meme->source == 'instagram')
<script async defer src="//www.instagram.com/embed.js"></script>
@endif

@if($meme->source == 'tiktok')
<script async defer src="https://www.tiktok.com/embed.js"></script>
@endif
@endsection 