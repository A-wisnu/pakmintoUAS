@extends("layouts.app")

@section("content")
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="fw-bold mb-4">Privacy Policy</h1>
            
            <p class="lead mb-4">Your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your personal information.</p>
            
            <div class="mb-5">
                <h4>1. Information We Collect</h4>
                <p>We collect information you provide directly to us when you create an account, such as your name, email address, and profile information. We also collect information about your use of our services, including your IP address, browser type, and pages visited.</p>
            </div>
            
            <div class="mb-5">
                <h4>2. How We Use Your Information</h4>
                <p>We use the information we collect to:</p>
                <ul>
                    <li>Provide, maintain, and improve our services</li>
                    <li>Personalize your experience</li>
                    <li>Communicate with you about our services</li>
                    <li>Monitor and analyze trends and usage</li>
                    <li>Detect and prevent fraud and abuse</li>
                </ul>
            </div>
            
            <div class="mb-5">
                <h4>3. Sharing Your Information</h4>
                <p>We do not share your personal information with third parties except in the following cases:</p>
                <ul>
                    <li>With your consent</li>
                    <li>To comply with legal obligations</li>
                    <li>To protect our rights and the rights of others</li>
                    <li>In connection with a merger, sale, or acquisition</li>
                </ul>
            </div>
            
            <div class="mb-5">
                <h4>4. Data Security</h4>
                <p>We take reasonable measures to protect your personal information from unauthorized access, use, or disclosure. However, no method of transmission over the Internet or electronic storage is 100% secure.</p>
            </div>
            
            <div class="mb-5">
                <h4>5. Cookies</h4>
                <p>We use cookies and similar technologies to collect information about your browsing activities and to personalize your experience on our site.</p>
            </div>
            
            <div class="mb-5">
                <h4>6. Your Rights</h4>
                <p>You have the right to access, correct, or delete your personal information. You can manage your account settings or contact us to exercise these rights.</p>
            </div>
            
            <div class="mb-5">
                <h4>7. Changes to This Policy</h4>
                <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page.</p>
            </div>
            
            <div class="mt-5">
                <a href="{{ route("terms") }}" class="btn btn-primary">Terms of Service</a>
                <a href="{{ route("home") }}" class="btn btn-outline-secondary ms-2">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
