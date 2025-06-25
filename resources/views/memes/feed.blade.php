@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Meme Feed</h1>
            <p class="text-muted">View Instagram and TikTok meme content</p>
        </div>
        <div class="col-md-4 text-md-end">
            @auth
            <a href="{{ route('memes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add Content
            </a>
            @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary">
                <i class="fas fa-sign-in-alt me-1"></i> Login to Add Content
            </a>
            @endauth
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            @forelse($memes as $meme)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ $meme->user->profile->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($meme->user->name) . '&background=random' }}" 
                            class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;" 
                            alt="{{ $meme->user->name }}">
                        <div>
                            <a href="{{ route('user.profile', $meme->user) }}" class="text-decoration-none fw-bold">{{ $meme->user->name }}</a>
                            <small class="d-block text-muted">{{ $meme->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <span class="badge bg-primary">
                        <i class="fab fa-{{ $meme->source == 'instagram' ? 'instagram' : 'tiktok' }}"></i>
                        {{ ucfirst($meme->source) }}
                    </span>
                </div>
                
                <div class="card-body">
                    <h5 class="card-title">{{ $meme->title }}</h5>
                    
                    <div class="mb-3">
                        <div class="video-container">
                            @if($meme->source == 'instagram')
                            <blockquote class="instagram-media" data-instgrm-permalink="{{ $meme->content_url }}" data-instgrm-version="14"></blockquote>
                            @elseif($meme->source == 'tiktok')
                            <blockquote class="tiktok-embed" cite="{{ $meme->content_url }}"></blockquote>
                            @endif
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <form action="{{ route('memes.like', $meme) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-heart me-1"></i> Like ({{ $meme->likes }})
                                </button>
                            </form>
                        </div>
                        
                        <div>
                            <span class="me-2">
                                <i class="fas fa-eye"></i> {{ $meme->views }} views
                            </span>
                            
                            @if(Auth::check() && Auth::id() === $meme->user_id)
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="{{ route('memes.edit', $meme) }}" class="dropdown-item">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('memes.destroy', $meme) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this meme?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-1"></i> No external content found. Be the first to share Instagram or TikTok content!
            </div>
            @endforelse
            
            <div class="d-flex justify-content-center mt-4">
                {{ $memes->links() }}
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header bg-light">
                    <h5 class="mb-0">How to Share Content</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6><i class="fab fa-instagram text-danger me-1"></i> Instagram Content</h6>
                        <ol class="ps-3">
                            <li>Find an Instagram post or reel</li>
                            <li>Click the "..." menu</li>
                            <li>Select "Copy Link"</li>
                            <li>Paste the link when creating new meme</li>
                        </ol>
                    </div>
                    
                    <div>
                        <h6><i class="fab fa-tiktok me-1"></i> TikTok Content</h6>
                        <ol class="ps-3">
                            <li>Find a TikTok video</li>
                            <li>Click the "Share" icon</li>
                            <li>Select "Copy Link"</li>
                            <li>Paste the link when creating new meme</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script async defer src="//www.instagram.com/embed.js"></script>
<script async defer src="https://www.tiktok.com/embed.js"></script>
@endsection 