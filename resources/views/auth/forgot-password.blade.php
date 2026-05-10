@extends('auth.layout.app')

@section('content')
<!-- FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/auth_forgot.css') }}">

<div class="auth-full-wrapper">
    <div class="container-custom">
        <!-- FORM SIDE (LEFT) -->
        <div class="form-container">
            <div style="margin-bottom: 2rem; display: flex; align-items: center; gap: 10px;">
                <div style="width:35px; height:35px; background:var(--auth-grad); border-radius:10px; display:flex; align-items:center; justify-content:center; color:white; font-weight:900; font-size:1.2rem;">P</div>
                <span style="font-family:'Syne', sans-serif; font-weight:800; font-size:1.2rem; color:var(--auth-text); margin-bottom:0;">PeopleDesk</span>
            </div>

            <h1>Recovery</h1>
            <p>No worries! Enter your email address and we'll send you a link to reset your password securely.</p>

            <!-- Session Status -->
            @if (session('status'))
            <div class="success-msg">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" style="width:100%;">
                @csrf

                <input type="email" name="email" class="form-input" placeholder="Enter your email address" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror

                <button type="submit" class="btn-auth">Send Reset Link →</button>
            </form>

            <div style="margin-top: 2rem;">
                <a href="{{ route('login') }}" style="color:var(--auth-primary); font-weight:700; text-decoration:none; font-size:0.9rem;">← Back to Sign In</a>
            </div>
        </div>

        <!-- OVERLAY SIDE (RIGHT) -->
        <div class="overlay-container">
            <h1>Security First!</h1>
            <p>Your data security is our top priority. We use industry-standard encryption to ensure your recovery is safe and private.</p>
            <div style="width:80px; height:80px; background:rgba(255,255,255,0.1); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:2rem; margin-top:1rem;">🛡️</div>
        </div>
    </div>
</div>
@endsection