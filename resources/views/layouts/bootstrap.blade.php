<!doctype html>
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

    <!--Bootstrap -->
    {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--}}
    @vite(['resources/js/bootstrap5.js', 'resources/js/sweetalert2.js', 'resources/js/web-app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">

    <style>

        * {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .text_title {
            color: rgba(8, 23, 44, 1);
            font-weight: bold;
        }

        .gradient-custom-2 {
            /* fallback for old browsers */
            background: rgb(42, 177, 199);

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(90deg, rgba(42, 177, 199, 1) 0%, rgba(41, 149, 209, 1) 50%, rgba(41, 94, 228, 1) 100%);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(90deg, rgba(42, 177, 199, 1) 0%, rgba(41, 149, 209, 1) 50%, rgba(41, 94, 228, 1) 100%);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }

        @media (min-width: 768px) {
            #scale {
                transform: scale(0.8); /* Reduce el tamaño al 80% */
            }
        }

        /*--------------------------------------------------------------
        # Preloader
        --------------------------------------------------------------*/
        #preloader {
            position: fixed;
            inset: 0;
            z-index: 999999;
            overflow: hidden;
            background: #ffffff;
            transition: all 0.6s ease-out;
        }

        #preloader:before {
            content: "";
            position: fixed;
            top: calc(50% - 30px);
            left: calc(50% - 30px);
            border: 6px solid #ffffff;
            border-color: #1977cc transparent #1977cc transparent;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: animate-preloader 1.5s linear infinite;
        }

        @keyframes animate-preloader {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

    </style>

    @stack('css')
    @livewireStyles
</head>
<body style="background-color: #eee;">

<div class="position-relative gradient-form" style="min-height: 100vh;">
    <div class="position-absolute top-50 start-50 translate-middle container">


        <div id="scale" class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <div x-data class="text-center mt-4 mt-md-auto mx-3 mx-md-auto">
                                    <a href="{{ route('web.index') }}" @click="mostrarPreloader()">
                                        <img class="img-fluid" src="{{ asset('img/logo.png') }}" alt="Logo">
                                    </a>
                                    <h6 class="my-4 text_title">
                                        <strong>{{ Str::upper(config('app.name')) }}</strong>
                                    </h6>
                                </div>

                                @yield('content')

                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-flex align-items-center gradient-custom-2" style="min-height: 70vh">
                            <div class="w-100 text-white text-center">
                                <h3>Desarrollado por</h3>
                                <a href="https://t.me/Leothan" target="_blank"
                                   class="text-white text-decoration-none">Ing. Yonathan Castillo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Preloader -->
<div id="preloader"></div>

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>--}}
<script type="application/javascript">

    //Script para ejecurar el preloader
    window.addEventListener('load', function () {
        document.querySelector('#preloader').classList.add('d-none');
    });

    //Validar Formularios
    (() => {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                } else {
                    mostrarPreloader();
                }
                form.classList.add('was-validated');
            }, false);
        })
    })();

    console.log('Hi!')
</script>

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
