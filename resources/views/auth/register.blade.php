@extends('auth.layout.app')

@section('content')
<!-- FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/auth_register.css') }}">

<style>
    .form-container h1, .overlay-container h1 { font-family: 'Syne', sans-serif; }
    .form-container p, .form-container span, .overlay-container p, .btn-auth { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>

<div class="auth-full-wrapper">
    <div class="container-custom" id="container">
        <div class="form-container">
            <div style="margin-bottom: 2rem; display: flex; align-items: center; gap: 10px;">
                <div style="width:35px; height:35px; background:var(--auth-grad); border-radius:10px; display:flex; align-items:center; justify-content:center; color:white; font-weight:900; font-size:1.2rem;">P</div>
                <span style="font-family:'Syne', sans-serif; font-weight:800; font-size:1.2rem; color:var(--auth-text); margin-bottom:0;">PeopleDesk</span>
            </div>
            <form method="POST" action="{{ route('register') }}" style="width:100%;">
                @csrf
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" style="width:auto; padding:0 20px; border-radius:20px; gap:10px;">
                        <i class="bi bi-google"></i>
                        <span style="font-size:12px; font-weight:700;">Sign up with Google</span>
                    </a>
                </div>
                <span>or use your email for registration</span>

                <input type="text" name="name" class="form-input" placeholder="Name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                @error('name') <span class="error-msg">{{ $message }}</span> @enderror

                <input type="email" name="email" class="form-input" placeholder="Email" value="{{ old('email') }}" required autocomplete="username" />
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror

                <input type="password" name="password" class="form-input" placeholder="Password" required autocomplete="new-password" />
                @error('password') <span class="error-msg">{{ $message }}</span> @enderror

                <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm Password" required autocomplete="new-password" />

                <button type="submit" class="btn-auth">Sign Up</button>
            </form>
        </div>

        <!-- OVERLAY SIDE (LEFT) -->
        <div class="overlay-container">
            <h1>Welcome Back!</h1>
            <p>To keep connected with us please login with your personal info</p>
            <a href="{{ route('login') }}" style="text-decoration:none;">
                <button class="btn-auth btn-ghost">Sign In</button>
            </a>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
@endsection