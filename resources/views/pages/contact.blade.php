@extends("layouts.app")

@section("content")
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="fw-bold mb-4">Contact Us</h1>
            
            <p class="lead mb-4">Have questions, suggestions, or feedback? We would love to hear from you!</p>
            
            <div class="card border-0 shadow-sm rounded-4 mb-5">
                <div class="card-body p-4">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Enter subject">
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
            
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fas fa-envelope fa-2x text-primary"></i>
                        </div>
                        <h5>Email</h5>
                        <p>contact@memehub.com</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fas fa-phone fa-2x text-primary"></i>
                        </div>
                        <h5>Phone</h5>
                        <p>+1 (555) 123-4567</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <h5>Location</h5>
                        <p>Meme City, Internet</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-5">
                <a href="{{ route("home") }}" class="btn btn-outline-secondary">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
