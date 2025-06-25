@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Edit Meme</h4>
                    <a href="{{ route('memes.show', $meme) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('memes.update', $meme) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $meme->title) }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            @if($meme->type == 'image')
                            <img src="{{ $meme->content_url }}" class="img-thumbnail mb-2" alt="{{ $meme->title }}" style="max-height: 200px;">
                            @else
                            <div class="video-container mb-2" style="max-height: 200px;">
                                @if($meme->source == 'instagram' || $meme->source == 'tiktok')
                                <div class="border rounded p-3 bg-light text-center">
                                    {{ $meme->content_url }}
                                </div>
                                @else
                                <video controls class="w-100" style="max-height: 200px;">
                                    <source src="{{ $meme->content_url }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                @endif
                            </div>
                            @endif
                            
                            <div class="d-flex mt-2">
                                <span class="badge bg-secondary me-2">{{ ucfirst($meme->type) }}</span>
                                <span class="badge bg-info">Source: {{ ucfirst($meme->source) }}</span>
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Meme
                            </button>

                            <form action="{{ route('memes.destroy', $meme) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this meme?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-1"></i> Delete Meme
                                </button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 