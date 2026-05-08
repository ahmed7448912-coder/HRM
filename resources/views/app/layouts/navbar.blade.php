<!-- HEADER SECTION -->
<nav class="navbar">
    <div class="container nav-container">
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-icon">P</div>
            PeopleDesk
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('features') }}">Features</a></li>
            <li><a href="{{ route('solutions') }}">Solutions</a></li>
            <li><a href="{{ route('pricing') }}">Pricing</a></li>
            <li><a href="{{ route('resources') }}">Resources</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('contact') }}">Contact Us</a></li>
        </ul>
        <div class="nav-btns">
            <a href="{{ route('login') }}" class="btn btn-ghost">Log In</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Start Free Trial</a>
        </div>
    </div>
</nav>