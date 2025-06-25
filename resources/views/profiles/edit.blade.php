@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Edit Profile</h4>
                    <a href="{{ route('profile.show', $profile) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back to Profile
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', $profile) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 text-center">
                            <img src="{{ $profile->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($profile->user->name) . '&background=random&size=150' }}" 
                                alt="{{ $profile->user->name }}" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>

                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">
                            <small class="form-text text-muted">Recommended size: 200x200 pixels (JPG, PNG, GIF)</small>
                            @error('profile_picture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4">{{ old('bio', $profile->bio) }}</textarea>
                            <small class="form-text text-muted">Tell us about yourself (max 1000 characters)</small>
                            @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <hr>
                        
                        <div class="mb-3">
                            <p class="text-muted mb-1">Account Information</p>
                            <h5>{{ $profile->user->name }}</h5>
                            <p class="text-muted">{{ $profile->user->email }}</p>
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                To change your name or email, please visit account settings.
                            </small>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 