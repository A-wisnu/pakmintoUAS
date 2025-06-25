@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-header">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                <img src="{{ $profile->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&size=200' }}" 
                     alt="{{ $user->name }}" class="profile-picture">
            </div>
            <div class="col-md-9">
                <h2>{{ $user->name }}</h2>
                <p class="text-muted">{{ $user->email }}</p>
                
                @if($profile->bio)
                <p>{{ $profile->bio }}</p>
                @endif
                
                <div class="d-flex">
                    <div class="me-4">
                        <strong>{{ $user->memes->count() }}</strong> memes
                    </div>
                    <div class="me-4">
                        <strong>{{ $user->memes->sum('likes') }}</strong> likes
                    </div>
                    <div>
                        <strong>{{ $user->memes->sum('views') }}</strong> views
                    </div>
                </div>
                
                @if(Auth::id() === $user->id)
                <div class="mt-3">
                    <a href="{{ route('profile.edit', $profile) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-1"></i> Edit Profile
                    </a>
                    <a href="{{ route('secret-codes.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-key me-1"></i> Manage Secret Codes
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-12">
            <h3>
                <i class="fas fa-photo-video me-2"></i>
                {{ $user->name }}'s Memes
            </h3>
        </div>
    </div>

    <div class="row">
        @forelse($memes as $meme)
        <div class="col-md-4">
            <div class="card meme-card shadow-sm">
                <div class="card-img-top">
                    @if($meme->type == 'image')
                    <a href="{{ route('memes.show', $meme) }}">
                        <img src="{{ $meme->content_url }}" class="img-fluid" alt="{{ $meme->title }}">
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
                        <small class="text-muted">
                            {{ $meme->created_at->format('M d, Y') }}
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
                <i class="fas fa-info-circle me-2"></i>
                No memes found. @if(Auth::id() === $user->id) <a href="{{ route('memes.create') }}">Create your first meme!</a> @endif
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
@endsection 