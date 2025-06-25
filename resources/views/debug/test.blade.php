<!DOCTYPE html>
<html>
<head>
    <title>Debug Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .meme-card { border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        img { max-width: 300px; height: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Debug Test Page</h1>
        <p>This is a simple page to test if Blade templating is working.</p>
        
        <h2>Basic Blade Tests:</h2>
        <p>Current time: {{ date('Y-m-d H:i:s') }}</p>
        <p>Random number: {{ rand(1, 100) }}</p>
        
        <h2>Memes from Database:</h2>
        
        @forelse($memes as $meme)
            <div class="meme-card">
                <h3>{{ $meme->title }}</h3>
                <p>Type: {{ $meme->type }}</p>
                <p>Source: {{ $meme->source }}</p>
                <p>URL: {{ $meme->content_url }}</p>
                
                @if($meme->type == 'image')
                    <img src="{{ $meme->content_url }}" alt="{{ $meme->title }}">
                @endif
                
                <p>Views: {{ $meme->views }} | Likes: {{ $meme->likes }}</p>
            </div>
        @empty
            <p>No memes found in database!</p>
        @endforelse
    </div>
</body>
</html> 