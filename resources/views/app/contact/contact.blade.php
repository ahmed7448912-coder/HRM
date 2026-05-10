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

            <div class="showcase-list animate-up delay-3">
                <div class="contact-info-card">
                    <div class="item-num">📧</div>
                    <div>
                        <h4>Email Us</h4>
                        <p>support@peopledesk.com</p>
                    </div>
                </div>
                <div class="contact-info-card">
                    <div class="item-num">📍</div>
                    <div>
                        <h4>Visit Us</h4>
                        <p> Faisalabad, Punjab, Pakistan </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="hero-visual animate-up delay-2">
            <div class="contact-form-container">
                @if(session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" placeholder="John Doe" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Work Email</label>
                            <input type="email" name="email" placeholder="john@company.com" class="form-input" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <select name="subject" class="form-select">
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Enterprise Pricing">Enterprise Pricing</option>
                            <option value="Support Request">Support Request</option>
                            <option value="Partnership">Partnership</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea name="message" rows="4" placeholder="How can we help?" class="form-textarea" required></textarea>
                    </div>
                    <button class="btn btn-primary btn-submit">Send Message →</button>
                </form>
            </div>
        </div>
    </div>
</header>
<!-- OFFICE LOCATIONS SECTION -->
<section class="section-padding section-locations">
    <div class="container">
        <div class="features-header">
            <h2 class="hero-h1">Global <span class="text-gradient">Presence.</span></h2>
            <p class="hero-p">Our teams are distributed across the globe to provide you with 24/7 support.</p>
        </div>
        <div class="feature-grid">
            <div class="feature-card office-card">
                <h3 class="feature-h3">Faisalabad</h3>
                <p>124 City Road, Faisalabad, Punjab, Pakistan</p>
                <div class="office-phone">046 324 5077</div>
            </div>
            <div class="feature-card office-card">
                <h3 class="feature-h3">Toba Tek Singh</h3>
                <p>137 city road, Toba tek Singh, Punjab, Pakistan</p>
                <div class="office-phone">046 320 1234</div>
            </div>
            <div class="feature-card office-card">
                <h3 class="feature-h3">Lahore</h3>
                <p>137 city road, Lahore, Punjab, Pakistan</p>
                <div class="office-phone">042 320 1234</div>
            </div>
        </div>
    </div>
</section>
@endsection