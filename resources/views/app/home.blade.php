@extends('app.layouts.app')

@section('content')
<!-- MAIN BODY SECTION -->

<header class="hero">
    <div class="container hero-grid">
        <div class="hero-content">
            <div class="hero-tag animate-up">
                <span class="live-dot" style="width:8px;height:8px;background:var(--accent);border-radius:50%;"></span>
                PeopleDesk 2026 is now live
            </div>
            <h1 class="hero-h1 animate-up delay-1">Manage your workforce <span class="text-gradient">smarter.</span></h1>
            <p class="hero-p animate-up delay-2">Ditch the spreadsheets. PeopleDesk centralizes HR, payroll, and performance into one intelligent command center built for modern teams.</p>
            <div class="hero-btns animate-up delay-3">
                <a href="{{ route('register') }}" class="btn btn-primary" style="padding:1rem 2.5rem; font-size:1.1rem;">Get Started Free →</a>
                <a href="#" class="btn btn-ghost" style="padding:1rem 2rem; border:1px solid var(--gray-200);">▶ Watch Demo</a>
            </div>
            <div class="trusted-by animate-up delay-3" style="border:none; padding:0; opacity:0.6;">
                <p style="font-size:0.85rem; font-weight:700; color:var(--gray-400); margin-bottom:1.5rem; text-transform:uppercase; letter-spacing:1px;">Trusted by 500+ Innovators</p>
                <div style="display:flex; gap:2.5rem; flex-wrap:wrap;">
                    <span class="brand-logo" style="font-size:1.1rem;">TECHCO</span>
                    <span class="brand-logo" style="font-size:1.1rem;">FINOVA</span>
                    <span class="brand-logo" style="font-size:1.1rem;">BUILD.IO</span>
                    <span class="brand-logo" style="font-size:1.1rem;">SCALE</span>
                </div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="dashboard-preview">
                <div style="display:flex; gap:8px; margin-bottom:20px;">
                    <div style="width:100px;height:10px;background:#ff5f57;border-radius:50%;"></div>
                    <div style="width:10px;height:10px;background:#ffbd2e;border-radius:50%;"></div>
                    <div style="width:10px;height:10px;background:#28c840;border-radius:50%;"></div>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:25px;">
                    <div style="background:var(--gray-50); padding:20px; border-radius:16px;">
                        <div style="font-size:0.7rem; color:var(--gray-400); font-weight:800; text-transform:uppercase; margin-bottom:5px;">Staff Active</div>
                        <div style="font-size:2rem; font-weight:800; color:var(--dark); font-family:var(--font-heading);">2,451</div>
                    </div>
                    <div style="background:var(--gray-50); padding:20px; border-radius:16px;">
                        <div style="font-size:0.7rem; color:var(--gray-400); font-weight:800; text-transform:uppercase; margin-bottom:5px;">Efficiency</div>
                        <div style="font-size:2rem; font-weight:800; color:var(--accent); font-family:var(--font-heading);">98.4%</div>
                    </div>
                </div>
                <div style="height:150px; background:var(--gray-50); border-radius:16px; padding:20px; display:flex; align-items:flex-end; gap:10px;">
                    <div style="flex:1; height:40%; background:var(--primary); border-radius:4px; opacity:0.3;"></div>
                    <div style="flex:1; height:60%; background:var(--primary); border-radius:4px; opacity:0.5;"></div>
                    <div style="flex:1; height:80%; background:var(--primary); border-radius:4px; opacity:0.7;"></div>
                    <div style="flex:1; height:95%; background:var(--primary); border-radius:4px;"></div>
                    <div style="flex:1; height:70%; background:var(--primary); border-radius:4px; opacity:0.6;"></div>
                    <div style="flex:1; height:50%; background:var(--primary); border-radius:4px; opacity:0.4;"></div>
                </div>
            </div>
        </div>
    </div>
</header>


@endsection