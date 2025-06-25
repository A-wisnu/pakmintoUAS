@extends('layouts.app')

@section('content')
<div class="reels-container">
    @if(count($memes) > 0)
        <div class="reels-wrapper">
            @foreach($memes as $index => $meme)
                <div class="reel-item {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                    <div class="reel-content">
                        <h3>{{ $meme->title }}</h3>
                        <p>By: {{ $meme->user->name }}</p>
                        
                        @if($meme->source == 'instagram')
                            <div class="instagram-embed">
                                <a href="{{ $meme->content_url }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset('storage/instagram_placeholder.jpg') }}" alt="{{ $meme->title }}" onerror="this.src='https://via.placeholder.com/400x600?text=Instagram+Content'">
                                </a>
                                <p><a href="{{ $meme->content_url }}" target="_blank" class="btn btn-primary mt-3">View on Instagram</a></p>
                            </div>
                        @elseif($meme->source == 'tiktok')
                            <div class="tiktok-embed">
                                <a href="{{ $meme->content_url }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset('storage/tiktok_placeholder.jpg') }}" alt="{{ $meme->title }}" onerror="this.src='https://via.placeholder.com/400x600?text=TikTok+Content'">
                                </a>
                                <p><a href="{{ $meme->content_url }}" target="_blank" class="btn btn-primary mt-3">View on TikTok</a></p>
                            </div>
                        @else
                            <div class="media-container">
                                @if($meme->type == 'image')
                                    <img src="{{ $meme->content_url }}" alt="{{ $meme->title }}" class="img-fluid">
                                @elseif($meme->type == 'video')
                                    <video controls class="video-fluid">
                                        <source src="{{ $meme->content_url }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="reels-navigation">
            <button class="prev-btn" disabled>Previous</button>
            <button class="next-btn">Next</button>
        </div>
    @else
        <div class="no-memes">
            <p>No memes found.</p>
        </div>
    @endif
</div>

<style>
    body, html {
        margin: 0;
        padding: 0;
        overflow: hidden;
    }
    
    .reels-container {
        width: 100%;
        height: 100vh;
        position: relative;
        overflow: hidden;
        background-color: #000;
        color: #fff;
    }
    
    .reels-wrapper {
        width: 100%;
        height: 100%;
        position: relative;
    }
    
    .reel-item {
        width: 100%;
        height: 100vh;
        position: absolute;
        top: 0;
        left: 0;
        display: none;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px;
    }
    
    .reel-item.active {
        display: flex;
    }
    
    .reel-content {
        max-width: 500px;
        padding: 20px;
        background-color: rgba(0,0,0,0.7);
        border-radius: 10px;
        text-align: center;
    }
    
    .reels-navigation {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .prev-btn, .next-btn {
        padding: 10px 20px;
        background-color: rgba(255,255,255,0.2);
        border: none;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    
    .prev-btn:hover, .next-btn:hover {
        background-color: rgba(255,255,255,0.3);
    }
    
    .prev-btn:disabled, .next-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .no-memes {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        text-align: center;
    }
    
    .instagram-embed, .tiktok-embed, .media-container {
        margin-top: 20px;
        max-width: 100%;
    }
    
    .instagram-embed img, .tiktok-embed img, .media-container img, .media-container video {
        max-width: 100%;
        max-height: 60vh;
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    .btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: #4361ee;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 10px;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        background-color: #3f37c9;
        transform: translateY(-2px);
    }
    
    .mt-3 {
        margin-top: 15px;
    }
    
    h3 {
        margin-bottom: 15px;
        font-size: 24px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Reels navigation
    const reelItems = document.querySelectorAll('.reel-item');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    
    if (reelItems.length === 0) return;
    
    let activeIndex = 0;
    
    function showReel(index) {
        // Hide all reels
        reelItems.forEach(item => {
            item.classList.remove('active');
        });
        
        // Show active reel
        reelItems[index].classList.add('active');
        
        // Update navigation buttons
        prevBtn.disabled = index === 0;
        nextBtn.disabled = index === reelItems.length - 1;
        
        // Update active index
        activeIndex = index;
    }
    
    // Initialize first reel
    showReel(0);
    
    // Navigation button clicks
    prevBtn.addEventListener('click', () => {
        if (activeIndex > 0) {
            showReel(activeIndex - 1);
        }
    });
    
    nextBtn.addEventListener('click', () => {
        if (activeIndex < reelItems.length - 1) {
            showReel(activeIndex + 1);
        }
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowUp' && activeIndex > 0) {
            showReel(activeIndex - 1);
        } else if (e.key === 'ArrowDown' && activeIndex < reelItems.length - 1) {
            showReel(activeIndex + 1);
        }
    });
    
    // Swipe navigation for touch devices
    let touchStartY = 0;
    let touchEndY = 0;
    
    document.addEventListener('touchstart', (e) => {
        touchStartY = e.changedTouches[0].screenY;
    }, false);
    
    document.addEventListener('touchend', (e) => {
        touchEndY = e.changedTouches[0].screenY;
        handleSwipe();
    }, false);
    
    function handleSwipe() {
        const swipeThreshold = 50; // minimum swipe distance in pixels
        
        if (touchEndY < touchStartY - swipeThreshold) {
            // Swipe up - next
            if (activeIndex < reelItems.length - 1) {
                showReel(activeIndex + 1);
            }
        } else if (touchEndY > touchStartY + swipeThreshold) {
            // Swipe down - previous
            if (activeIndex > 0) {
                showReel(activeIndex - 1);
            }
        }
    }
});
</script>
@endsection