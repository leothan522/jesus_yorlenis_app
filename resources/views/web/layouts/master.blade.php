<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - {{ config('app.name', 'Yorlenis App') }}</title>

    <meta name="description" content="Dra. Yorlenis Uzcátegui · Ginecólogo Obstetra · ULA">
    <meta name="theme-color" content="#1a1a1a">
    <meta property="og:title" content="Yorlenis App">
    <meta property="og:description" content="Dra. Yorlenis Uzcátegui · Ginecólogo Obstetra · ULA">
    <meta property="og:image" content="{{ asset('favicons/appicon-128x128.png') }}">

    {{-- Favicon y PWA --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/appicon-32x32.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicons/appicon-128x128.png') }}">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/medilab/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/medilab/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/medilab/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/medilab/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/medilab/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/medilab/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('vendor/medilab/assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Medilab
    * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
    * Updated: Aug 07 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->

    @stack('css')
    @livewireStyles
</head>

<body class="index-page">

<header id="header" class="header sticky-top">

    @include('web.layouts.topbar')

    <div class="branding d-flex align-items-center">

        <div class="container position-relative d-flex align-items-center justify-content-between">

            @include('web.layouts.logo')

            @include('web.layouts.navmenu')

        </div>

    </div>

</header>

<main class="main">

    <!-- Hero Section -->
    @include('web.layouts.hero')
    <!-- /Hero Section -->

    @yield('content')

</main>

@include('web.layouts.footer')

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ asset('vendor/medilab/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/medilab/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('vendor/medilab/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('vendor/medilab/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('vendor/medilab/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('vendor/medilab/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('vendor/medilab/assets/js/main.js') }}"></script>

{{--Recursos del proyecto--}}
@include('sweetalert2::index')
@stack('js')
@livewireScripts

<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register("{{ asset('service-worker.js') }}")
                .then(reg => console.log('✅ Service Worker registrado en:', reg.scope))
                .catch(err => console.error('⚠️ Error al registrar el Service Worker:', err));
        });
    }
</script>
</body>
</html>
