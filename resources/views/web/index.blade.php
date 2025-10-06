@extends('web.layouts.master')

@section('title', __('Home'))

@section('content')

    <!-- Hero Section -->
    @include('web.layouts.hero')
    <!-- /Hero Section -->

    <!-- About Section -->
    @include('web.sections.about-section')
    <!-- /About Section -->

    <!-- Doctors Section -->
    @include('web.sections.doctors-section')
    <!-- /Doctors Section -->

@endsection

@push('js')
    <script>
        function mostrarAlertAuth() {
            Swal.fire({
                title: 'Accede para agendar tu cita',
                text: 'Para continuar, debes estar registrado o iniciar sesión. Es rápido y seguro.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Registrarme',
                cancelButtonText: 'Ya tengo cuenta',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-secondary me-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    mostrarPreloader();
                    window.location.href = "{{ route('register') }}";
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    mostrarPreloader();
                    window.location.href = "{{ route('login') }}";
                }
            });
        }
    </script>
@endpush
