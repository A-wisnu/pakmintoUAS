@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-card-header">
                <h2 class="auth-title">Welcome Back!</h2>
                <p class="auth-subtitle">Sign in to continue your meme journey</p>
            </div>

            <div class="auth-card-body">
                <div class="auth-shape shape-1"></div>
                <div class="auth-shape shape-2"></div>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="auth-form-group">
                        <div class="auth-input-wrapper">
                            <span class="auth-input-icon"><i class="fas fa-envelope"></i></span>
                            <input id="email" type="email" class="auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
                        </div>
                        @error('email')
                            <span class="auth-invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="auth-form-group">
                        <div class="auth-input-wrapper">
                            <span class="auth-input-icon"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                            <span class="auth-toggle-password" onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="auth-invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="auth-form-group remember-group">
                        <div class="auth-checkbox-wrapper">
                            <input class="auth-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="auth-checkbox-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="auth-forgot-link" href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <!-- CAPTCHA-like Secret Code Verification -->
                    <div class="auth-form-group">
                        <label class="auth-captcha-label">Complete the Phrase: <span id="secretCodePhrase" class="auth-captcha-phrase">{{ \App\Models\SecretCode::generateFunnyPhrase() }}</span></label>
                        <div class="auth-input-wrapper">
                            <span class="auth-input-icon"><i class="fas fa-shield-alt"></i></span>
                            <input id="captcha" type="text" class="auth-input @error('captcha') is-invalid @enderror" name="captcha" placeholder="Type exactly as shown above" required>
                        </div>
                        @error('captcha')
                            <span class="auth-invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </span>
                        @enderror
                        <input type="hidden" name="expected_captcha" id="expectedCaptcha" value="{{ \App\Models\SecretCode::generateFunnyPhrase() }}">
                    </div>

                    <div class="auth-form-group">
                        <button type="submit" class="auth-button">
                            <span>Sign In</span> <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
                
                <div class="auth-footer">
                    Don't have an account? <a href="{{ route('register') }}" class="auth-link">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Floating emojis -->
    <div class="auth-emoji emoji-1">😂</div>
    <div class="auth-emoji emoji-2">🔥</div>
    <div class="auth-emoji emoji-3">🚀</div>
    <div class="auth-emoji emoji-4">💯</div>
</div>

<style>
    :root {
        --primary-color: #0080ff;
        --gradient-end: #00c3ff;
        --accent-color: #FF5500;
        --accent-gradient-end: #FF7B54;
        --dark-color: #333333;
        --light-color: #f8f9fa;
    }
    
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9f0ff 100%);
        position: relative;
        overflow: hidden;
        padding: 2rem 0;
    }
    
    .auth-wrapper {
        width: 100%;
        max-width: 450px;
        z-index: 2;
        position: relative;
    }
    
    .auth-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
    }
    
    .auth-card-header {
        background: linear-gradient(45deg, var(--primary-color), var(--gradient-end));
        padding: 2.5rem 2rem;
        text-align: center;
        color: white;
    }
    
    .auth-title {
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }
    
    .auth-subtitle {
        font-size: 1rem;
        opacity: 0.9;
    }
    
    .auth-card-body {
        padding: 2.5rem 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .auth-shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.05;
        z-index: 0;
    }
    
    .shape-1 {
        width: 200px;
        height: 200px;
        background-color: var(--primary-color);
        top: -100px;
        right: -100px;
    }
    
    .shape-2 {
        width: 150px;
        height: 150px;
        background-color: var(--accent-color);
        bottom: -75px;
        left: -75px;
    }
    
    .auth-form-group {
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }
    
    .auth-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .auth-input-icon {
        position: absolute;
        left: 15px;
        color: #aaa;
        transition: all 0.3s ease;
    }
    
    .auth-input {
        width: 100%;
        padding: 0.8rem 1rem 0.8rem 2.8rem;
        border: 2px solid #eee;
        border-radius: 50px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .auth-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 5px 15px rgba(0, 128, 255, 0.1);
    }
    
    .auth-input:focus + .auth-input-icon {
        color: var(--primary-color);
    }
    
    .auth-toggle-password {
        position: absolute;
        right: 15px;
        color: #aaa;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .auth-toggle-password:hover {
        color: var(--primary-color);
    }
    
    .auth-invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        padding-left: 1rem;
    }
    
    .remember-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .auth-checkbox-wrapper {
        display: flex;
        align-items: center;
    }
    
    .auth-checkbox {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        accent-color: var(--primary-color);
    }
    
    .auth-checkbox-label {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0;
    }
    
    .auth-forgot-link {
        font-size: 0.9rem;
        color: var(--primary-color);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .auth-forgot-link:hover {
        color: var(--gradient-end);
        text-decoration: underline;
    }
    
    .auth-button {
        width: 100%;
        padding: 1rem;
        border: none;
        border-radius: 50px;
        background: linear-gradient(45deg, var(--primary-color), var(--gradient-end));
        color: white;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 20px rgba(0, 128, 255, 0.2);
    }
    
    .auth-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0, 128, 255, 0.3);
    }
    
    .auth-footer {
        text-align: center;
        font-size: 0.95rem;
        color: #666;
    }
    
    .auth-link {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .auth-link:hover {
        color: var(--gradient-end);
        text-decoration: underline;
    }
    
    .auth-emoji {
        position: absolute;
        font-size: 2.5rem;
        animation: float 6s ease-in-out infinite;
        opacity: 0.3;
        z-index: 1;
    }
    
    .emoji-1 {
        top: 15%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .emoji-2 {
        top: 20%;
        right: 15%;
        animation-delay: 1s;
    }
    
    .emoji-3 {
        bottom: 15%;
        right: 10%;
        animation-delay: 2s;
    }
    
    .emoji-4 {
        bottom: 20%;
        left: 15%;
        animation-delay: 3s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }
    
    @media (max-width: 576px) {
        .auth-wrapper {
            width: 90%;
        }
        
        .auth-card-header {
            padding: 2rem 1.5rem;
        }
        
        .auth-card-body {
            padding: 2rem 1.5rem;
        }
    }
    
    .auth-captcha-label {
        display: block;
        margin-bottom: 0.5rem;
        color: #555;
        font-weight: 500;
    }
    
    .auth-captcha-phrase {
        font-weight: bold;
        color: var(--primary-color);
        background-color: rgba(0, 128, 255, 0.05);
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        letter-spacing: 0.5px;
    }
</style>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const icon = document.querySelector('.auth-toggle-password i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Make sure the expected captcha and displayed captcha are the same
        const displayedPhrase = document.getElementById('secretCodePhrase').innerText;
        document.getElementById('expectedCaptcha').value = displayedPhrase;
    });
</script>
@endsection
