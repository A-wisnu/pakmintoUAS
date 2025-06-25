<!-- Floating Emojis Component -->
<div class="side-floating-emojis">
    <div class="side-emoji emoji-frog">🐸</div>
    <div class="side-emoji emoji-love">❤️</div>
    <div class="side-emoji emoji-lol">
        <div class="lol-bubble">LOL</div>
    </div>
    <div class="side-emoji emoji-fire">🔥</div>
    <div class="side-emoji emoji-party">🎉</div>
    <div class="side-emoji emoji-frog">🐸</div>
    <div class="side-emoji emoji-love">❤️</div>
    <div class="side-emoji emoji-fire">🔥</div>
</div>

<style>
    .side-floating-emojis {
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        width: 100px;
        z-index: 10;
        pointer-events: none;
    }
    
    .side-emoji {
        position: absolute;
        font-size: 1.8rem;
        opacity: 0.9;
        will-change: transform;
        animation-duration: 12s;
        animation-timing-function: ease-in-out;
        animation-iteration-count: infinite;
    }
    
    .lol-bubble {
        background-color: #FFCC00;
        border-radius: 50%;
        padding: 10px 20px;
        font-weight: bold;
        font-size: 24px;
        color: #FF3333;
    }
    
    .emoji-frog {
        animation-name: float-and-bounce;
    }

    .emoji-love {
        animation-name: float-and-pulse;
        animation-duration: 10s;
    }

    .emoji-lol {
        animation-name: float-and-rotate;
        animation-duration: 15s;
    }

    .emoji-fire {
        animation-name: float-and-scale;
        animation-duration: 8s;
    }

    .emoji-party {
        animation-name: float-and-twist;
        animation-duration: 14s;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the container
        const container = document.querySelector('.side-floating-emojis');
        if (!container) return;

        // Get all emoji elements
        const emojis = document.querySelectorAll('.side-emoji');
        
        // Set random positions for each emoji
        emojis.forEach(emoji => {
            // Generate random positions within the side bar
            const randomY = Math.random() * 80 + 10; // 10% to 90% of height
            
            // Apply random positions
            emoji.style.left = `${Math.random() * 40 + 10}px`; // 10px to 50px from left
            emoji.style.top = `${randomY}%`;
            
            // Add random animation delay
            emoji.style.animationDelay = `${Math.random() * 5}s`;
        });
    });
</script> 