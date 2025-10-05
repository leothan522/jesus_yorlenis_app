@extends('web.layouts.master')

@section('title', __('Home'))

@section('content')

    <!-- About Section -->
    @include('web.sections.about-section')
    <!-- /About Section -->

    <!-- Stats Section -->
    @include('web.sections.stats-section')
    <!-- /Stats Section -->

    <!-- Services Section -->
    @include('web.sections.services-section')
    <!-- /Services Section -->

    <!-- Appointment Section -->
    @include('web.sections.appointment-section')
    <!-- /Appointment Section -->

    <!-- Departments Section -->
    @include('web.sections.departments-section')
    <!-- /Departments Section -->

    <!-- Doctors Section -->
    @include('web.sections.doctors-section')
    <!-- /Doctors Section -->

    <!-- Faq Section -->
    @include('web.sections.faq-section')
    <!-- /Faq Section -->

    <!-- Testimonials Section -->
    @include('web.sections.testimonials-section')
    <!-- /Testimonials Section -->

    <!-- Gallery Section -->
    @include('web.sections.gallery-section')
    <!-- /Gallery Section -->

    <!-- Contact Section -->
    @include('web.sections.contact-section')
    <!-- /Contact Section -->

@endsection
