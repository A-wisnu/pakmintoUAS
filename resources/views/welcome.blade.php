@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #0080ff;
        --gradient-end: #00c3ff;
        --accent-color: #FF5500;
        --accent-gradient-end: #FF7B54;
        --dark-color: #333333;
        --light-color: #f8f9fa;
    }
    
    .hero-section {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6rem 0;
        overflow: hidden;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9f0ff 100%);
    }
    
    .hero-bg {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 0;
    }
    
    .animated-circle {
        position: absolute;
        border-radius: 50%;
        opacity: 0.4;
    }
    
    .circle-1 {
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, var(--primary-color) 0%, transparent 70%);
        top: -100px;
        right: -100px;
        animation: float 15s ease-in-out infinite alternate;
    }
    
    .circle-2 {
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, var(--accent-color) 0%, transparent 70%);
        bottom: -250px;
        left: -200px;
        animation: float 20s ease-in-out infinite alternate-reverse;
    }
    
    .animated-shape {
        position: absolute;
        opacity: 0.2;
    }
    
    .shape-1 {
        width: 150px;
        height: 150px;
        background: var(--primary-color);
        top: 15%;
        left: 10%;
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        animation: morph 15s linear infinite, float 10s ease-in-out infinite alternate;
    }
    
    .shape-2 {
        width: 100px;
        height: 100px;
        background: var(--accent-color);
        top: 20%;
        right: 15%;
        border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        animation: morph 12s linear infinite, float 8s ease-in-out infinite alternate;
    }
    
    .shape-3 {
        width: 80px;
        height: 80px;
        background: #9340FF;
        bottom: 15%;
        right: 20%;
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        animation: morph 10s linear infinite, float 15s ease-in-out infinite alternate;
    }
    
    @keyframes morph {
        0% {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }
        25% {
            border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
        }
        50% {
            border-radius: 30% 30% 70% 70% / 60% 40% 60% 40%;
        }
        75% {
            border-radius: 60% 40% 40% 60% / 30% 60% 40% 70%;
        }
        100% {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin: 0 auto;
    }
    
    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }
    
    .gradient-text {
        background: linear-gradient(45deg, var(--primary-color), var(--gradient-end));
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
        position: relative;
    }
    
    .text-highlight {
        position: relative;
        z-index: 1;
        display: inline-block;
    }
    
    .text-highlight::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 30%;
        bottom: 5px;
        left: 0;
        background-color: rgba(255, 85, 0, 0.2);
        z-index: -1;
        transition: all 0.3s ease;
    }
    
    .text-highlight:hover::after {
        height: 50%;
        background-color: rgba(255, 85, 0, 0.3);
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        color: #555;
        margin-bottom: 2.5rem;
    }
    
    .search-container {
        max-width: 650px;
        margin: 0 auto 2.5rem;
    }
    
    .search-input {
        padding: 1rem 1.5rem;
        border-radius: 30px 0 0 30px;
        border: 2px solid transparent;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        flex-grow: 1;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        background-color: white;
    }
    
    .search-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 10px 30px rgba(0, 128, 255, 0.15);
    }
    
    .search-button {
        padding: 1rem 2rem;
        background: linear-gradient(45deg, var(--primary-color), var(--gradient-end));
        border: none;
        border-radius: 0 30px 30px 0;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 128, 255, 0.2);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .search-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0, 128, 255, 0.3);
    }
    
    .hero-actions {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 3rem;
        position: relative;
        z-index: 3;
    }
    
    .hero-btn {
        padding: 1rem 2rem;
        border-radius: 30px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 180px;
    }
    
    .browse-btn {
        background: linear-gradient(45deg, var(--primary-color), var(--gradient-end));
        color: white;
        box-shadow: 0 10px 30px rgba(0, 128, 255, 0.2);
    }
    
    .browse-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 128, 255, 0.3);
        color: white;
    }
    
    .login-btn {
        background: white;
        color: var(--primary-color);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 2px solid var(--primary-color);
    }
    
    .login-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        color: var(--primary-color);
    }
    
    .create-btn {
        background: linear-gradient(45deg, var(--accent-color), var(--accent-gradient-end));
        color: white;
        box-shadow: 0 10px 30px rgba(255, 85, 0, 0.2);
    }
    
    .create-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(255, 85, 0, 0.3);
        color: white;
    }
    
    /* Category bubbles */
    .category-bubbles {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-top: 1rem;
    }
    
    .category-bubble {
        background: white;
        border-radius: 20px;
        padding: 0.6rem 1.2rem;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        color: #555;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .category-bubble:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        color: var(--primary-color);
    }
    
    .category-bubble i {
        color: var(--primary-color);
        font-size: 1.1rem;
    }
    
    /* Emoji decorations */
    .emoji-yellow {
        position: absolute;
        left: 10%;
        top: 30%;
        font-size: 5rem;
        z-index: 1;
        animation: float 6s ease-in-out infinite alternate, spin 15s linear infinite;
    }
    
    .emoji-lol {
        position: absolute;
        right: 28%;
        top: 15%;
        font-size: 5rem;
        font-weight: bold;
        color: #FF5500;
        transform: rotate(15deg);
        z-index: 1;
        animation: float 7s ease-in-out infinite alternate-reverse;
    }
    
    .emoji-red {
        position: absolute;
        left: 23%;
        top: 65%;
        font-size: 4rem;
        z-index: 1;
        animation: float 8s ease-in-out infinite alternate;
    }
    
    .emoji-black1 {
        position: absolute;
        left: 50%;
        top: 65%;
        font-size: 4rem;
        z-index: 1;
        animation: float 9s ease-in-out infinite alternate-reverse;
    }
    
    .emoji-black2 {
        position: absolute;
        left: 60%;
        top: 65%;
        font-size: 4rem;
        z-index: 1;
        animation: float 7s ease-in-out infinite alternate;
    }
    
    .emoji-green {
        position: absolute;
        right: 15%;
        bottom: 15%;
        font-size: 4rem;
        z-index: 1;
        animation: float 10s ease-in-out infinite alternate-reverse;
    }
    
    .floating-emoji {
        transition: all 0.3s ease;
    }
    
    .floating-emoji:hover {
        transform: scale(1.2);
        cursor: pointer;
    }
    
    @keyframes float {
        0% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
        100% { transform: translateY(0) rotate(0deg); }
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 3rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
        }
        
        .hero-actions {
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        
        .hero-btn {
            width: 100%;
            max-width: 250px;
        }
        
        .category-bubbles {
            flex-wrap: nowrap;
            overflow-x: auto;
            padding-bottom: 15px;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .category-bubbles::-webkit-scrollbar {
            display: none;
        }
        
        .category-bubble {
            white-space: nowrap;
        }
        
        .emoji-yellow, .emoji-red, .emoji-green {
            font-size: 3rem;
        }
        
        .emoji-lol, .emoji-black1, .emoji-black2 {
            font-size: 2.5rem;
        }
    }
</style>

<div class="position-relative hero-section">
    <!-- Animated background elements -->
    <div class="hero-bg">
        <div class="animated-circle circle-1"></div>
        <div class="animated-circle circle-2"></div>
        <div class="animated-shape shape-1"></div>
        <div class="animated-shape shape-2"></div>
        <div class="animated-shape shape-3"></div>
    </div>

    <!-- Core hero content -->
    <div class="container text-center position-relative">
        <div class="hero-content">
            <h1 class="hero-title">
                <span class="gradient-text">Endless Memes</span><br>
                <span class="text-highlight">for Every Occasion</span>
            </h1>
            <p class="hero-subtitle">Discover, share and create the best memes on the internet,<br>all in one place with our growing community.</p>
            
            <div class="search-container">
                <form action="{{ route('login') }}" method="GET" class="d-flex w-100">
                    <input type="text" name="search" class="search-input" placeholder="Search for memes...">
                    <button type="submit" class="search-button">
                        <i class="fas fa-search"></i>
                        <span>Search</span>
                    </button>
                </form>
            </div>
            
            <div class="hero-actions">
                <a href="{{ route('memes.feed') }}" class="hero-btn browse-btn">
                    <i class="fas fa-th-large me-2"></i> Browse Memes
                </a>
            </div>
            
            <!-- Category bubbles -->
            <div class="category-bubbles">
                <div class="category-bubble">
                    <i class="fas fa-laugh-squint"></i>
                    <span>Funny</span>
                </div>
                <div class="category-bubble">
                    <i class="fas fa-fire"></i>
                    <span>Trending</span>
                </div>
                <div class="category-bubble">
                    <i class="fas fa-gamepad"></i>
                    <span>Gaming</span>
                </div>
                <div class="category-bubble">
                    <i class="fas fa-paw"></i>
                    <span>Animals</span>
                </div>
                <div class="category-bubble">
                    <i class="fas fa-film"></i>
                    <span>Movies</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Emoji decorations -->
    <div class="emoji-yellow floating-emoji">
        <span>😂</span>
    </div>
    
    <div class="emoji-lol floating-emoji">
        <span>LOL</span>
    </div>
    
    <div class="emoji-red floating-emoji">
        <span>🔥</span>
    </div>
    
    <div class="emoji-black1 floating-emoji">
        <span>🤣</span>
    </div>
    
    <div class="emoji-black2 floating-emoji">
        <span>😎</span>
    </div>
    
    <div class="emoji-green floating-emoji">
        <span>🐸</span>
    </div>
</div>

<style>
    .emoji-yellow {
        position: absolute;
        left: 10%;
        top: 30%;
        font-size: 5rem;
    }
    
    .emoji-lol {
        position: absolute;
        right: 15%;
        top: 15%;
        font-size: 5rem;
        font-weight: bold;
        color: #FF5500;
        transform: rotate(15deg);
    }
    
    .emoji-red {
        position: absolute;
        left: 23%;
        top: 65%;
        font-size: 4rem;
    }
    
    .emoji-black1 {
        position: absolute;
        left: 50%;
        top: 65%;
        font-size: 4rem;
    }
    
    .emoji-black2 {
        position: absolute;
        left: 60%;
        top: 65%;
        font-size: 4rem;
    }
    
    .emoji-green {
        position: absolute;
        right: 15%;
        bottom: 15%;
        font-size: 4rem;
    }
    
    .browse-btn-container {
        margin-top: 40px;
        text-align: center;
        position: relative;
        z-index: 10;
    }
    
    /* Why Choose MemeHub Section Styles */
    .features-section {
        padding: 6rem 0;
        position: relative;
        overflow: hidden;
    }
    
    .section-title {
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        background: linear-gradient(45deg, var(--primary-color), var(--gradient-end));
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }
    
    .section-subtitle {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 2.5rem;
    }
    
    .feature-card {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        transition: all 0.4s ease;
        position: relative;
        z-index: 1;
        background-color: white;
    }
    
    .feature-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 40px rgba(0, 128, 255, 0.15);
    }
    
    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, var(--primary-color), var(--gradient-end));
        opacity: 0;
        z-index: -1;
        transition: all 0.4s ease;
        border-radius: 20px;
    }
    
    .feature-card:hover::before {
        opacity: 1;
    }
    
    .feature-card:hover .card-title,
    .feature-card:hover .card-text {
        color: white;
    }
    
    .feature-icon-wrapper {
        height: 110px;
        width: 110px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        border-radius: 50%;
        background-color: rgba(0, 128, 255, 0.1);
        transition: all 0.4s ease;
        position: relative;
    }
    
    .feature-card:hover .feature-icon-wrapper {
        background-color: rgba(255, 255, 255, 0.2);
        transform: scale(1.1) rotate(5deg);
    }
    
    .feature-icon-wrapper::after {
        content: '';
        position: absolute;
        height: 90px;
        width: 90px;
        border-radius: 50%;
        border: 2px dashed rgba(0, 128, 255, 0.3);
        animation: spin 20s linear infinite;
    }
    
    .feature-card:hover .feature-icon-wrapper::after {
        border-color: rgba(255, 255, 255, 0.3);
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .feature-icon {
        font-size: 3rem;
        transition: all 0.4s ease;
    }
    
    .feature-badge {
        position: absolute;
        top: -10px;
        right: -10px;
        background: linear-gradient(45deg, #FF7B54, #FF5500);
        color: white;
        border-radius: 30px;
        padding: 5px 15px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(255, 85, 0, 0.3);
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.4s ease;
    }
    
    .feature-card:hover .feature-badge {
        opacity: 1;
        transform: translateY(0);
    }
    
    .feature-card:nth-child(1) .feature-badge {
        background: linear-gradient(45deg, #FF7B54, #FF5500);
    }
    
    .feature-card:nth-child(2) .feature-badge {
        background: linear-gradient(45deg, #0080ff, #00c3ff);
    }
    
    .feature-card:nth-child(3) .feature-badge {
        background: linear-gradient(45deg, #9340FF, #FF3EBF);
    }
    
    .feature-card:nth-child(1) .feature-icon-wrapper {
        background-color: rgba(255, 123, 84, 0.1);
    }
    
    .feature-card:nth-child(2) .feature-icon-wrapper {
        background-color: rgba(0, 128, 255, 0.1);
    }
    
    .feature-card:nth-child(3) .feature-icon-wrapper {
        background-color: rgba(147, 64, 255, 0.1);
    }
    
    .card-title {
        font-weight: 700;
        font-size: 1.4rem;
        margin-bottom: 1rem;
        transition: all 0.4s ease;
    }
    
    .card-text {
        font-size: 1rem;
        color: #666;
        transition: all 0.4s ease;
    }
    
    .feature-details {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px dashed #ddd;
        display: flex;
        justify-content: space-between;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }
    
    .feature-card:hover .feature-details {
        opacity: 1;
        transform: translateY(0);
    }
    
    .feature-detail-item {
        display: flex;
        align-items: center;
        color: white;
    }
    
    .feature-detail-item i {
        margin-right: 5px;
    }
    
    .features-bg-shape {
        position: absolute;
        width: 600px;
        height: 600px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(0, 128, 255, 0.05) 0%, rgba(255, 255, 255, 0) 70%);
        z-index: 0;
    }
    
    .shape-top-right {
        top: -300px;
        right: -300px;
    }
    
    .shape-bottom-left {
        bottom: -300px;
        left: -300px;
    }
    
    .shape-middle-right {
        top: 50%;
        right: -400px;
        transform: translateY(-50%);
    }
    
    .discover-icon {
        color: #FF7B54;
    }
    
    .share-icon {
        color: #0080ff;
    }
    
    .create-icon {
        color: #9340FF;
    }
</style>

<section class="features-section">
    <!-- Background shapes -->
    <div class="features-bg-shape shape-top-right"></div>
    <div class="features-bg-shape shape-bottom-left"></div>
    <div class="features-bg-shape shape-middle-right"></div>
    
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="section-title">Why Choose MemeHub?</h2>
                <p class="section-subtitle">The ultimate platform for meme lovers to discover, share, and create content.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 mb-4">
                <div class="feature-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <span class="feature-badge">Popular</span>
                        <div class="feature-icon-wrapper">
                            <i class="fas fa-search-plus feature-icon discover-icon"></i>
                        </div>
                        <h4 class="card-title">Discover</h4>
                        <p class="card-text">Find trending memes across different categories tailored to your interests and preferences. Our algorithm learns what makes you laugh!</p>
                        
                        <div class="feature-details">
                            <div class="feature-detail-item">
                                <i class="fas fa-tag"></i> Categories
                            </div>
                            <div class="feature-detail-item">
                                <i class="fas fa-fire"></i> Trending
                            </div>
                            <div class="feature-detail-item">
                                <i class="fas fa-user"></i> Personalized
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="feature-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <span class="feature-badge">Easy</span>
                        <div class="feature-icon-wrapper">
                            <i class="fas fa-share-alt feature-icon share-icon"></i>
                        </div>
                        <h4 class="card-title">Share</h4>
                        <p class="card-text">Easily share your favorite memes with friends across social media platforms with just one click. Direct message, post, or download options available.</p>
                        
                        <div class="feature-details">
                            <div class="feature-detail-item">
                                <i class="fab fa-instagram"></i> Instagram
                            </div>
                            <div class="feature-detail-item">
                                <i class="fab fa-twitter"></i> Twitter
                            </div>
                            <div class="feature-detail-item">
                                <i class="fab fa-facebook"></i> Facebook
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="feature-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <span class="feature-badge">Fun</span>
                        <div class="feature-icon-wrapper">
                            <i class="fas fa-magic feature-icon create-icon"></i>
                        </div>
                        <h4 class="card-title">Create</h4>
                        <p class="card-text">Use our easy tools to create your own viral memes in seconds. Access templates, add text, images, and effects without any design skills.</p>
                        
                        <div class="feature-details">
                            <div class="feature-detail-item">
                                <i class="fas fa-images"></i> Templates
                            </div>
                            <div class="feature-detail-item">
                                <i class="fas fa-palette"></i> Effects
                            </div>
                            <div class="feature-detail-item">
                                <i class="fas fa-text-height"></i> Text Tools
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Trending Memes Section Styles */
    .trending-section {
        padding: 5rem 0;
        position: relative;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9f0ff 100%);
        border-radius: 30px;
        margin: 5rem 0;
        overflow: hidden;
    }
    
    .trending-title {
        font-weight: 800;
        font-size: 2.5rem;
        position: relative;
        z-index: 2;
    }
    
    .trending-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(to right, var(--primary-color), var(--gradient-end));
        border-radius: 2px;
    }
    
    .trending-subtitle {
        margin-bottom: 2rem;
        font-size: 1.1rem;
        color: #555;
    }
    
    .trending-btn {
        padding: 0.8rem 2rem;
        background: linear-gradient(45deg, var(--primary-color), var(--gradient-end));
        border: none;
        border-radius: 30px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 5px 15px rgba(0, 128, 255, 0.3);
        text-decoration: none;
        display: inline-block;
    }
    
    .trending-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 128, 255, 0.4);
        color: white;
    }
    
    .trending-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: all 0.4s ease;
    }
    
    .trending-btn:hover::before {
        left: 100%;
    }
    
    .meme-card {
        border-radius: 15px;
        overflow: hidden;
        border: none;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .meme-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .meme-card-label {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        padding: 30px 15px 15px;
        color: white;
        font-weight: 600;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
    }
    
    .meme-card:hover .meme-card-label {
        opacity: 1;
        transform: translateY(0);
    }
    
    .meme-card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(0, 128, 255, 0.5), rgba(0, 195, 255, 0.5));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .meme-card:hover .meme-card-overlay {
        opacity: 0.85;
    }
    
    .meme-card-actions {
        display: flex;
        gap: 10px;
    }
    
    .meme-action-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transform: scale(0);
        transition: all 0.3s ease;
    }
    
    .meme-card:hover .meme-action-btn {
        transform: scale(1);
    }
    
    .meme-action-btn:hover {
        background: var(--primary-color);
        color: white;
    }
    
    .trending-bg-circle {
        position: absolute;
        border-radius: 50%;
        z-index: 0;
    }
    
    .circle-1 {
        width: 300px;
        height: 300px;
        background-color: rgba(0, 128, 255, 0.05);
        top: -150px;
        right: -150px;
    }
    
    .circle-2 {
        width: 200px;
        height: 200px;
        background-color: rgba(0, 195, 255, 0.05);
        bottom: -100px;
        left: -100px;
    }
    
    .circle-3 {
        width: 100px;
        height: 100px;
        background-color: rgba(255, 123, 84, 0.05);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    .trending-fire-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        color: #ff5500;
        font-size: 2rem;
        z-index: 1;
        animation: flame 3s ease-in-out infinite;
    }
    
    @keyframes flame {
        0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.8; }
        50% { transform: scale(1.2) rotate(5deg); opacity: 1; }
    }
</style>

<section class="trending-section">
    <div class="trending-bg-circle circle-1"></div>
    <div class="trending-bg-circle circle-2"></div>
    <div class="trending-bg-circle circle-3"></div>
    <div class="trending-fire-icon">
        <i class="fas fa-fire"></i>
    </div>
    
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <h2 class="trending-title">Trending Memes</h2>
                <p class="trending-subtitle">Check out what's popular right now on MemeHub. Updated every hour with the freshest content!</p>
                <a href="{{ route('memes.feed') }}" class="trending-btn">
                    <i class="fas fa-fire-alt me-2"></i> See All Trending
                </a>
            </div>
            
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-12 text-center py-5">
                        <div class="empty-state">
                            <img src="https://i.pinimg.com/736x/fa/74/62/fa7462ef34fdb55d07548c824160e9f3.jpg" alt="Meme Placeholder" class="img-fluid mb-3" style="max-width: 300px; border-radius: 10px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                            <h4>Ready for Your Memes!</h4>
                            <p class="text-muted">Share your best memes and become part of our community. Upload your awesome meme creations now!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Join Community Section */
    .community-section {
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }
    
    .community-content {
        position: relative;
        z-index: 2;
        padding: 4rem 0;
    }
    
    .community-title {
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 1rem;
        background: linear-gradient(45deg, var(--primary-color), var(--gradient-end));
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }
    
    .community-subtitle {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 2rem;
    }
    
    .community-btn {
        padding: 1rem 2.5rem;
        background: linear-gradient(45deg, var(--primary-color), var(--gradient-end));
        border: none;
        border-radius: 30px;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 10px 30px rgba(0, 128, 255, 0.3);
        text-decoration: none;
        display: inline-block;
    }
    
    .community-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 128, 255, 0.4);
        color: white;
    }
    
    .community-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: all 0.6s ease;
    }
    
    .community-btn:hover::before {
        left: 100%;
    }
    
    .community-shape {
        position: absolute;
        z-index: 1;
    }
    
    .shape-circle-1 {
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(0, 128, 255, 0.05) 0%, rgba(255, 255, 255, 0) 60%);
        top: -250px;
        left: -250px;
    }
    
    .shape-circle-2 {
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(0, 195, 255, 0.05) 0%, rgba(255, 255, 255, 0) 60%);
        bottom: -200px;
        right: -200px;
    }
    
    .community-stats {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
        gap: 3rem;
    }
    
    .stat-item {
        text-align: center;
        padding: 0 1rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stat-icon {
        margin-right: 0.5rem;
        font-size: 1.8rem;
    }
    
    .stat-label {
        font-size: 1rem;
        color: #666;
        font-weight: 500;
    }
    
    .community-pattern {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%230080ff' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
        z-index: 0;
    }
</style>

<section class="community-section">
    <div class="community-pattern"></div>
    <div class="community-shape shape-circle-1"></div>
    <div class="community-shape shape-circle-2"></div>
    
    <div class="container">
        <div class="community-content text-center">
            <h2 class="community-title">Join Our Meme Community</h2>
            <p class="community-subtitle">Connect with thousands of meme enthusiasts and creators from around the world</p>
            
            @guest
                <a href="{{ route('register') }}" class="community-btn">
                    <i class="fas fa-rocket me-2"></i> Create Account
                </a>
            @else
                <a href="{{ route('memes.create') }}" class="community-btn">
                    <i class="fas fa-plus-circle me-2"></i> Create Your First Meme
                </a>
            @endguest
            
            <div class="community-stats">
                <div class="stat-item">
                    <div class="stat-number">
                        <span class="stat-icon"><i class="fas fa-users"></i></span>
                        <span>50K+</span>
                    </div>
                    <div class="stat-label">Active Users</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">
                        <span class="stat-icon"><i class="fas fa-images"></i></span>
                        <span>100K+</span>
                    </div>
                    <div class="stat-label">Memes Shared</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">
                        <span class="stat-icon"><i class="fas fa-globe"></i></span>
                        <span>120+</span>
                    </div>
                    <div class="stat-label">Countries</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 