@extends('auth.layout.app')

@section('content')
<!-- FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/auth_login.css') }}">

<style>
    .form-container h1,
    .overlay-container h1 {
        font-family: 'Syne', sans-serif;
    }

    .form-container p,
    .form-container span,
    .overlay-container p,
    .btn-auth {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
</style>

<div class="auth-full-wrapper">
    <a href="{{ route('home') }}" class="back-home-btn">
        <div class="icon"><i class="bi bi-arrow-left"></i></div>
        <span>Back to Home</span>
    </a>
    <div class="container-custom" id="container">
        <div class="form-container">
            <div style="margin-bottom: 2rem; display: flex; align-items: center; gap: 10px;">
                <div style="width:35px; height:35px; background:var(--auth-grad); border-radius:10px; display:flex; align-items:center; justify-content:center; color:white; font-weight:900; font-size:1.2rem;">P</div>
                <span style="font-family:'Syne', sans-serif; font-weight:800; font-size:1.2rem; color:var(--auth-text); margin-bottom:0;">PeopleDesk</span>
            </div>
            <form method="POST" action="{{ route('login') }}" style="width:100%;">
                @csrf
                <h1>Sign in</h1>
                <div class="social-container" style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('google.redirect') }}" class="animate-social">
                        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google">
                        <span>Google</span>
                    </a>
                    <a href="{{ route('auth.facebook') }}" class="animate-social facebook-btn" style="animation-delay: 0.2s;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png" alt="Facebook">
                        <span>Facebook</span>
                    </a>
                </div>
                <span>or use your account</span>

                @if (session('status'))
                <div style="color:#2ecc71; font-size:12px; margin-bottom:10px;">{{ session('status') }}</div>
                @endif

                @if (session('error'))
                <div style="color:#ff4b2b; font-size:12px; margin-bottom:10px; font-weight:700;">{{ session('error') }}</div>
                @endif

                <input type="email" name="email" class="form-input" placeholder="Email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror

                <input type="password" name="password" class="form-input" placeholder="Password" required autocomplete="current-password" />
                @error('password') <span class="error-msg">{{ $message }}</span> @enderror

                <a href="{{ route('password.request') }}" class="forgot">Forgot your password?</a>

                <div style="display:flex; align-items:center; gap:8px; margin-bottom:15px;">
                    <input type="checkbox" name="remember" id="remember_me" style="width:auto;">
                    <label for="remember_me" style="font-size:12px; color:#666;">Remember me</label>
                </div>

                <button type="submit" class="btn-auth">Sign In</button>
            </form>
        </div>

        <!-- OVERLAY SIDE (RIGHT) -->
        <div class="overlay-container">
            <h1>Hello, Friend!</h1>
            <p>Enter your personal details and start journey with us</p>
            <a href="{{ route('register') }}" style="text-decoration:none;">
                <button class="btn-auth btn-ghost">Sign Up</button>
            </a>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
@endsection