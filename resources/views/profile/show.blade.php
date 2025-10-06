@extends('web.layouts.master')

@section('title', __('Profile'))

@section('content')

    <!-- Page Title -->
    @include('web.layouts.breadcrumbs')
    <!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

        <!-- Section Title -->
        <div class="container section-title d-none" data-aos="fade-up">
            <h2>Starter Section</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div>
        <!-- End Section Title -->

        <div class="container" data-aos="fade-up">

            <div>
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')

                        <x-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.update-password-form')
                        </div>

                        <x-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.two-factor-authentication-form')
                        </div>

                        <x-section-border />
                    @endif

                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                        <x-section-border />

                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.delete-user-form')
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </section>
    <!-- /Starter Section Section -->

    <!-- About Section -->
    @include('web.sections.about-section')
    <!-- /About Section -->

    <!-- Doctors Section -->
    @include('web.sections.doctors-section')
    <!-- /Doctors Section -->

@endsection

@push('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush
