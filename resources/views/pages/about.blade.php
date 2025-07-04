@extends("layouts.app")

@section("content")
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="fw-bold mb-4">About MemeHub</h1>
            
            <p class="lead mb-4">MemeHub is the ultimate platform for discovering, sharing, and creating memes.</p>
            
            <p>Founded in 2023, MemeHub started with a simple mission: to bring joy and laughter to people through the universal language of memes. What began as a small project has grown into a vibrant community of meme enthusiasts from all around the world.</p>
            
            <h3 class="mt-5 mb-3">Our Mission</h3>
            <p>To create the most comprehensive and user-friendly platform for meme lovers, where creativity is celebrated and humor is shared.</p>
            
            <h3 class="mt-5 mb-3">Our Vision</h3>
            <p>To become the go-to destination for all things meme-related, fostering a global community that connects through humor and creativity.</p>
            
            <h3 class="mt-5 mb-3">Our Team</h3>
            <p>MemeHub is made possible by a dedicated team of meme enthusiasts, developers, and designers who are passionate about creating the best meme experience on the web.</p>
            
            <div class="mt-5">
                <a href="{{ route("contact") }}" class="btn btn-primary">Contact Us</a>
                <a href="{{ route("home") }}" class="btn btn-outline-secondary ms-2">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
