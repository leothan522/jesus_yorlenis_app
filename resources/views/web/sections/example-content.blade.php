@extends('web.layouts.master')

@section('title', __('Home'))

@section('content')

    <!-- About Section -->
    @include('web.sections.about-section')
    <!-- /About Section -->

    <!-- Stats Section -->
    {{--@include('web.sections.stats-section')--}}
    <!-- /Stats Section -->

    <!-- Services Section -->
    {{--@include('web.sections.services-section')--}}
    <!-- /Services Section -->

    <!-- Appointment Section -->
    @include('web.sections.appointment-section')
    <!-- /Appointment Section -->

    <!-- Departments Section -->
    {{--@include('web.sections.departments-section')--}}
    <!-- /Departments Section -->

    <!-- Doctors Section -->
    @include('web.sections.doctors-section')
    <!-- /Doctors Section -->

    <!-- Faq Section -->
    {{--@include('web.sections.faq-section')--}}
    <!-- /Faq Section -->

    <!-- Testimonials Section -->
    {{--@include('web.sections.testimonials-section')--}}
    <!-- /Testimonials Section -->

    <!-- Gallery Section -->
    {{--@include('web.sections.gallery-section')--}}
    <!-- /Gallery Section -->

    <!-- Contact Section -->
    {{--@include('web.sections.contact-section')--}}
    <!-- /Contact Section -->

@endsection

@push('js')
    <script>
        document.getElementById('btn-agendar').addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Deseas agendar una cita?',
                text: 'Para continuar, debes estar registrado o iniciar sesión. Es rápido y seguro.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Registrarme',
                cancelButtonText: 'Ya tengo cuenta',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('register') }}";
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        });
    </script>
@endpush
