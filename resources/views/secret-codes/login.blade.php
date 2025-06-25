@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="mb-0 text-center"><i class="fas fa-laugh-squint me-2"></i>Login with Secret Code</h4>
                </div>

                <div class="card-body">
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                
                    <div class="alert alert-info mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        Enter your secret code and the funny phrase associated with it to log in without a password.
                    </div>

                    <form method="POST" action="{{ route('login.secret-code.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="code" class="form-label">Secret Code</label>
                            <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="off" autofocus>
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="funny_phrase" class="form-label">Funny Phrase</label>
                            <input id="funny_phrase" type="text" class="form-control @error('funny_phrase') is-invalid @enderror" name="funny_phrase" required autocomplete="off">
                            @error('funny_phrase')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="form-text text-muted">
                                Enter the exact funny phrase associated with your secret code.
                            </small>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>

                        <hr>
                        
                        <div class="text-center">
                            <p>Don't have a secret code?</p>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary me-2">
                                    <i class="fas fa-user me-1"></i>Regular Login
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-user-plus me-1"></i>Register
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer bg-white text-center">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3 mb-md-0">
                                <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
                                <h6>Secure</h6>
                                <small class="text-muted">One-time use only</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 mb-md-0">
                                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                <h6>Limited Time</h6>
                                <small class="text-muted">Expires after 7 days</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <i class="fas fa-smile-beam fa-2x text-primary mb-2"></i>
                                <h6>Fun to Use</h6>
                                <small class="text-muted">With funny phrases</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 