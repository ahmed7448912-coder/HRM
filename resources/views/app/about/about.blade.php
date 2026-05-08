@extends('app.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/about.js') }}"></script>
@endpush

@section('content')
<!-- ABOUT HERO SECTION -->
<header class="about-hero">
    <div class="container">
        <div class="hero-tag animate-up">Our Mission</div>
        <h1 class="hero-h1 animate-up delay-1">We're building the <span class="text-gradient">operating system</span> for teams.</h1>
        <p class="hero-p animate-up delay-2" style="margin: 0 auto 3rem; max-width:800px;">PeopleDesk was born from a simple idea: HR shouldn't be a hurdle. We're on a mission to automate the administrative burden so you can focus on what actually matters—your people.</p>
        
        <div class="hero-visual animate-up delay-3">
            <div class="stats-dashboard">
                <div class="stats-grid">
                    <div class="stat-item">
                        <h2 class="stat-value" data-target="500">0+</h2>
                        <div class="stat-label">Companies</div>
                    </div>
                    <div class="stat-item">
                        <h2 class="stat-value" data-target="10">0k+</h2>
                        <div class="stat-label">Users</div>
                    </div>
                    <div class="stat-item">
                        <h2 class="stat-value" data-target="99.9">0%</h2>
                        <div class="stat-label">Uptime</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- THE JOURNEY SECTION -->
<section class="section-padding" style="background:var(--gray-50);">
    <div class="container hero-grid" style="align-items:center;">
        <div class="hero-visual animate-up">
            <div class="dashboard-preview" style="transform:none; background:var(--grad-indigo); padding:60px; height:300px; display:flex; align-items:center; justify-content:center;">
                <div style="font-size:5rem;">🌱</div>
            </div>
        </div>
        <div class="hero-content">
            <div class="hero-tag">The Journey</div>
            <h2 class="hero-h1" style="font-size:2.5rem;">How we started.</h2>
            <p class="hero-p">PeopleDesk began in a small garage with a big vision: to eliminate the friction that keeps teams from doing their best work. We saw HR professionals buried in paperwork and decided to build a tool that gives them their time back.</p>
            <p class="hero-p" style="margin-top:1rem;">Today, we're proud to support thousands of employees across the globe, but our mission remains the same—to put people first, always.</p>
        </div>
    </div>
</section>

<!-- VALUES SECTION -->
<section class="section-padding">
    <div class="container">
        <div class="features-header">
            <h2 class="hero-h1">The values that <span class="text-gradient">drive us.</span></h2>
        </div>
        <div class="feature-grid values-grid">
            <div class="feature-card value-card">
                <div class="feature-icon">🛡️</div>
                <h3 class="feature-h3">Trust & Security</h3>
                <p style="color:var(--gray-500); font-size:0.95rem;">We treat your data with the same care we treat our own. Security isn't a feature; it's our foundation.</p>
            </div>
            <div class="feature-card value-card">
                <div class="feature-icon">⚡</div>
                <h3 class="feature-h3">Radical Simplicity</h3>
                <p style="color:var(--gray-500); font-size:0.95rem;">Complex problems deserve simple solutions. We design for clarity and ease of use.</p>
            </div>
            <div class="feature-card value-card">
                <div class="feature-icon">🤝</div>
                <h3 class="feature-h3">People First</h3>
                <p style="color:var(--gray-500); font-size:0.95rem;">Behind every screen is a human being. We build technology that empowers, not replaces.</p>
            </div>
        </div>
    </div>
</section>

<!-- TEAM PREVIEW -->
<section class="section-padding" style="background:var(--dark); border-radius:50px 50px 0 0;">
    <div class="container" style="text-align:center;">
        <div class="hero-tag">Our Team</div>
        <h2 class="hero-h1" style="color:white;">Driven by <span class="text-gradient">innovation.</span></h2>
        <p class="hero-p" style="color:var(--gray-400); margin:0 auto 4rem;">A global team of engineers, designers, and HR experts working to redefine workforce management.</p>
        
        <div style="display:flex; justify-content:center; gap:2rem; flex-wrap:wrap;">
            <div class="team-bubble animate-up">
                <div class="bubble-icon">🎨</div>
                <div style="color:white; font-weight:700; margin-top:10px;">Design</div>
            </div>
            <div class="team-bubble animate-up delay-1">
                <div class="bubble-icon">💻</div>
                <div style="color:white; font-weight:700; margin-top:10px;">Engineering</div>
            </div>
            <div class="team-bubble animate-up delay-2">
                <div class="bubble-icon">📈</div>
                <div style="color:white; font-weight:700; margin-top:10px;">Growth</div>
            </div>
        </div>
    </div>
</section>
@endsection