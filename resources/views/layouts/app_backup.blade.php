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
            --primary-color: #0088cc;
            --secondary-color: #ffc107;
            --accent-color: #FF4433;
            --text-dark: #13171d;
            --text-light: #FFFFFF;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: white;
            color: var(--text-dark);
        }
        
        .navbar {
            background-color: white;
            padding: 15px 0;
            box-shadow: none;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--text-dark);
            display: flex;
            align-items: center;
        }
        
        .logo-img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            font-size: 2rem;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--text-dark) !important;
            margin: 0 15px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 6px;
            padding: 12px 25px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #0077b5;
            border-color: #0077b5;
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            border-radius: 6px;
            padding: 12px 25px;
            font-weight: 500;
        }
        
        .hero-section {
            padding: 80px 0 120px;
        }
        
        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--text-dark);
            text-align: center;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 50px;
            color: #666;
            text-align: center;
        }
        
        .search-container {
            max-width: 600px;
            margin: 0 auto 40px;
            display: flex;
            position: relative;
        }
        
        .search-input {
            height: 60px;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 0 20px;
            font-size: 1.1rem;
            width: 100%;
        }
        
        .search-button {
            position: absolute;
            right: 8px;
            top: 8px;
            height: 44px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0 25px;
            font-weight: 500;
        }
        
        .browse-btn {
            display: block;
            width: 200px;
            margin: 0 auto;
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 15px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 1.2rem;
            text-decoration: none;
        }
        
        .browse-btn:hover {
            background-color: #0077b5;
            color: white;
        }
        
        .floating-element {
            position: absolute;
            z-index: -1;
        }
        
        .floating-emoji {
            position: absolute;
            z-index: -1;
        }
        
        .emoji-laugh {
            left: 10%;
            top: 40%;
            font-size: 8rem;
        }
        
        .emoji-frog {
            right: 15%;
            bottom: 15%;
            font-size: 6rem;
        }
        
        .emoji-lol {
            right: 20%;
            top: 30%;
            font-size: 7rem;
        }
        
        .emoji-heart {
            left: 20%;
            bottom: 25%;
            font-size: 5rem;
        }
        
        .colored-dot {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            position: absolute;
            z-index: -1;
        }
        
        .dot-yellow {
            background-color: #FFD166;
            left: 10%;
            top: 20%;
        }
        
        .dot-blue {
            background-color: #118AB2;
            right: 15%;
            bottom: 40%;
        }
        
        .dot-blue-small {
            background-color: #118AB2;
            right: 35%;
            top: 30%;
            width: 10px;
            height: 10px;
        }
        
        .plus-shape {
            color: #118AB2;
            font-size: 2rem;
            position: absolute;
            left: 5%;
            bottom: 30%;
            z-index: -1;
        }
        
        .triangle-shape {
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-bottom: 30px solid #FF5E5B;
            position: absolute;
            right: 10%;
            bottom: 20%;
            transform: rotate(20deg);
            z-index: -1;
        }
        
        .meme-person {
            position: absolute;
            bottom: 10%;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            z-index: -1;
        }
        
        .footer {
            background-color: #f8f9fa;
            padding: 40px 0;
            margin-top: 100px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .search-container {
                flex-direction: column;
                padding: 0 15px;
            }
            
            .search-button {
                position: static;
                width: 100%;
                margin-top: 10px;
                height: 50px;
            }
            
            .floating-emoji {
                font-size: 4rem !important;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="https://placehold.co/50x50/ffcc00/000000.png?text=😀" alt="MemeHub Logo" class="logo-img">
                    MemeHub
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('memes.feed') }}">Trending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('memes.feed') }}">Categories</a>
                        </li>
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
                                    <a class="nav-link btn btn-primary text-white ms-3" href="{{ route('register') }}">
                                        Sign in
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
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
            @yield('content')
        </main>
        
        <footer class="footer">
            <div class="container">
                <div class="text-center">
                    <p>&copy; {{ date('Y') }} MemeHub. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
