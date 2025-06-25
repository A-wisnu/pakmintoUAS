document.addEventListener('DOMContentLoaded', function() {
    // Get the container
    const container = document.querySelector('.floating-emojis-container');
    if (!container) return;

    // Get all emoji elements
    const emojis = document.querySelectorAll('.emoji');
    
    // Set random initial positions for each emoji
    emojis.forEach(emoji => {
        // Generate random positions
        const randomX = Math.random() * 80; // Keep within 80% of the container width
        const randomY = Math.random() * 70; // Keep within 70% of the container height
        
        // Apply random positions
        emoji.style.left = `${randomX}%`;
        emoji.style.top = `${randomY}%`;
        
        // Add random animation delay
        emoji.style.animationDelay = `${Math.random() * 5}s`;
    });
}); 