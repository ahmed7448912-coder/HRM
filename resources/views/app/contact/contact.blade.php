@extends('app.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/contact.js') }}"></script>
@endpush

@section('content')
<!-- CONTACT HERO SECTION -->
<header class="contact-hero">
    <div class="container hero-grid">
        <div class="hero-content">
            <div class="hero-tag animate-up">Get in Touch</div>
            <h1 class="hero-h1 animate-up delay-1">How can we <span class="text-gradient">help you?</span></h1>
            <p class="hero-p animate-up delay-2">Have questions about our enterprise plans, custom integrations, or just want to say hello? Our team is ready to assist you.</p>
            
            <div class="showcase-list animate-up delay-3" style="margin-top:3rem;">
                <div class="contact-info-card">
                    <div class="item-num" style="width:50px; height:50px; font-size:1.2rem;">📧</div>
                    <div>
                        <h4 style="font-size:1.1rem; margin-bottom:0.2rem;">Email Us</h4>
                        <p style="color:var(--gray-500); font-size:0.9rem;">support@peopledesk.com</p>
                    </div>
                </div>
                <div class="contact-info-card">
                    <div class="item-num" style="width:50px; height:50px; font-size:1.2rem;">📍</div>
                    <div>
                        <h4 style="font-size:1.1rem; margin-bottom:0.2rem;">Visit Us</h4>
                        <p style="color:var(--gray-500); font-size:0.9rem;">123 Innovation Way, Tech Valley, CA</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="hero-visual animate-up delay-2">
            <div class="contact-form-container">
                <form action="#" method="POST" class="contact-form" style="display:flex; flex-direction:column; gap:1.5rem;">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" placeholder="John Doe" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Work Email</label>
                            <input type="email" placeholder="john@company.com" class="form-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <select class="form-select">
                            <option>General Inquiry</option>
                            <option>Enterprise Pricing</option>
                            <option>Support Request</option>
                            <option>Partnership</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea rows="4" placeholder="How can we help?" class="form-textarea" style="resize:none;"></textarea>
                    </div>
                    <button class="btn btn-primary" style="padding:1rem; width:100%; font-weight:800;">Send Message →</button>
                </form>
            </div>
        </div>
    </div>
</header>
<!-- OFFICE LOCATIONS SECTION -->
<section class="section-padding" style="background:var(--gray-50); border-radius:50px 50px 0 0;">
    <div class="container">
        <div class="features-header">
            <h2 class="hero-h1">Global <span class="text-gradient">Presence.</span></h2>
            <p class="hero-p" style="margin: 0 auto;">Our teams are distributed across the globe to provide you with 24/7 support.</p>
        </div>
        <div class="feature-grid">
            <div class="feature-card office-card">
                <h3 class="feature-h3">London</h3>
                <p style="color:var(--gray-500); font-size:0.9rem;">124 City Road, London, EC1V 2NX, UK</p>
                <div style="margin-top:1rem; color:var(--primary); font-weight:700;">+44 20 1234 5678</div>
            </div>
            <div class="feature-card office-card">
                <h3 class="feature-h3">New York</h3>
                <p style="color:var(--gray-500); font-size:0.9rem;">250 Park Ave, New York, NY 10177, USA</p>
                <div style="margin-top:1rem; color:var(--primary); font-weight:700;">+1 212 555 0123</div>
            </div>
            <div class="feature-card office-card">
                <h3 class="feature-h3">Dubai</h3>
                <p style="color:var(--gray-500); font-size:0.9rem;">Level 14, Boulevard Plaza, Dubai, UAE</p>
                <div style="margin-top:1rem; color:var(--primary); font-weight:700;">+971 4 555 6789</div>
            </div>
        </div>
    </div>
</section>
@endsection