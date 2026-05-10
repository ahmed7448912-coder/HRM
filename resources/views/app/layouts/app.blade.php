<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeopleDesk — The Future of Enterprise HCM</title>
    <meta name="description" content="PeopleDesk is the modern HR command center for high-performance teams.">

    <!-- Modular CSS Assets -->
    <link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animations.css') }}">
    @stack('styles')
</head>

<body>

    @include('app.layouts.navbar')

    <main id="main-content">
        @yield('content')
    </main>
    @if(Route::is('home'))
        @include('app.Feature.features')
        @include('app.showcase.showcase')
        @include('app.pricing.pricing')
        @include('app.resources.reviews')
        @include('app.resources.integrations')
        @include('app.resources.waves')
        @include('app.resources.faq')
    @endif
    @include('app.layouts.footer')

    <a href="https://wa.me/923071455815" class="whatsapp-float" target="_blank">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="white">
            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.747-2.874-2.512-2.96-2.626-.087-.114-.694-.925-.694-1.765s.437-1.252.592-1.416c.154-.164.338-.205.45-.205s.225.005.325.008c.107.003.251-.04.393.303.144.35.494 1.208.536 1.293.042.085.07.184.014.298-.056.114-.084.184-.168.284-.084.1-.176.223-.252.303-.094.1-.191.209-.083.393.108.184.481.794 1.031 1.284.708.631 1.306.827 1.49.911.184.084.292.071.401-.05.109-.121.464-.54.588-.725.124-.184.248-.154.42-.091.172.063 1.092.516 1.281.611.189.095.314.143.359.221.045.078.045.452-.1.857z" />
        </svg>
    </a>

    <!-- Modular JS Assets -->
    <script src="{{ asset('assets/js/core.js') }}"></script>
    <script src="{{ asset('assets/js/animations.js') }}"></script>
    <script src="{{ asset('assets/js/interactions.js') }}"></script>
    @stack('scripts')
</body>

</html>