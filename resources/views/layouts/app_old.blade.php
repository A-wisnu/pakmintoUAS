<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MemeHub') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Custom styles */
        :root {
            --primary-color: #FF4433;
            --secondary-color: #6C63FF;
            --accent-color: #FFD166;
            --text-dark: #333333;
            --text-light: #FFFFFF;
            --bg-light: #F8F9FA;
            --bg-dark: #212529;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }
        
        .logo-img {
            font-size: 2rem;
            margin-right: 10px;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--text-dark) !important;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #e03a2a;
            border-color: #e03a2a;
            transform: translateY(-2px);
        }
        
        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #FF7B54, #FF4433);
            padding: 80px 0;
            color: white;
            border-radius: 0 0 50px 50px;
            margin-bottom: 50px;
        }
        
        .search-container {
            background-color: white;
            border-radius: 50px;
            padding: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            display: flex;
        }
        
        .search-input {
            border: none;
            outline: none;
            padding: 12px 20px;
            width: 100%;
            font-size: 1rem;
            background: transparent;
        }
        
        .search-button {
            background-color: var(--primary-color);
            border: none;
            border-radius: 50px;
            color: white;
            padding: 12px 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .search-button:hover {
            background-color: #e03a2a;
            transform: translateY(-2px);
        }
        
        .meme-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            transition: all 0.3s;
        }
        
        .meme-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .card-img-top {
            width: 100%;
            height: auto;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .card-title {
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .card-text {
            color: #6c757d;
        }
        
        .profile-header {
            background: white;
            padding: 30px 0;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 16px;
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 16px;
        }
        
        .footer {
            background-color: var(--bg-dark);
            color: var(--text-light);
            padding: 60px 0 30px;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="logo-img">😂</span>
                    MemeHub
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('memes.feed') }}">Trending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('memes.feed') }}">Categories</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        Sign In
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn-sign-in" href="{{ route('register') }}">
                                        Sign in
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->profile ?? Auth::id()) }}">
                                        <i class="fas fa-id-card me-1"></i>Profile
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('memes.create') }}">
                                        <i class="fas fa-plus me-1"></i>Create Meme
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('secret-codes.index') }}">
                                        <i class="fas fa-key me-1"></i>Secret Codes
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-1"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="container py-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
        
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>MemeHub</h5>
                        <p>Share your favorite memes with the world!</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h5>Follow Us</h5>
                        <div class="social-links">
                            <a href="#" class="text-dark me-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-dark me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-dark"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <p class="mb-0">&copy; {{ date('Y') }} MemeHub. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
