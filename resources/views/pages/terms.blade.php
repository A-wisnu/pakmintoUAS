@extends("layouts.app")

@section("content")
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="fw-bold mb-4">Terms of Service</h1>
            
            <p class="lead mb-4">Please read these Terms of Service carefully before using MemeHub.</p>
            
            <div class="mb-5">
                <h4>1. Acceptance of Terms</h4>
                <p>By accessing or using MemeHub, you agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using or accessing this site.</p>
            </div>
            
            <div class="mb-5">
                <h4>2. User Content</h4>
                <p>Users may post content to MemeHub, including but not limited to images, text, and comments. By posting content, you grant MemeHub a non-exclusive, royalty-free license to use, reproduce, and distribute your content in connection with the service.</p>
                <p>You are solely responsible for the content you post. Content that is illegal, offensive, threatening, defamatory, or infringing upon intellectual property rights is strictly prohibited.</p>
            </div>
            
            <div class="mb-5">
                <h4>3. Account Responsibilities</h4>
                <p>If you create an account on MemeHub, you are responsible for maintaining the security of your account and for all activities that occur under your account. MemeHub cannot and will not be liable for any loss or damage from your failure to comply with this security obligation.</p>
            </div>
            
            <div class="mb-5">
                <h4>4. Intellectual Property</h4>
                <p>The MemeHub name, logo, and all related names, logos, product and service names, designs, and slogans are trademarks of MemeHub or its affiliates. You must not use such marks without the prior written permission of MemeHub.</p>
            </div>
            
            <div class="mb-5">
                <h4>5. Limitation of Liability</h4>
                <p>MemeHub shall not be liable for any direct, indirect, incidental, special, consequential, or punitive damages resulting from your use of or inability to use the service.</p>
            </div>
            
            <div class="mb-5">
                <h4>6. Changes to Terms</h4>
                <p>MemeHub reserves the right to modify or replace these Terms of Service at any time. It is your responsibility to check the Terms periodically for changes.</p>
            </div>
            
            <div class="mt-5">
                <a href="{{ route("privacy") }}" class="btn btn-primary">Privacy Policy</a>
                <a href="{{ route("home") }}" class="btn btn-outline-secondary ms-2">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
