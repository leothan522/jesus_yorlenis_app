<div class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div x-data class="contact-info d-flex align-items-center">
            <i class="bi bi-speedometer2 d-flex align-items-center"><a href="{{ route('filament.dashboard.pages.dashboard') }}" @click="mostrarPreloader()">Panel Administrativo</a></i>
            <i class="bi bi-phone d-flex align-items-center ms-4"><span>{{ formatearTelefonoParaView(getParametro('contact_telefono')) }}</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <a href="{{ getParametro('social_instagram') }}" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
            <a href="{{ getParametro('social_facebook') }}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="https://wa.me/{{ formatearTelefonoParaWhatsapp(getParametro('contact_telefono')) }}" target="_blank"><i class="bi bi-whatsapp"></i></a>
            <a href="mailto:{{ getParametro('contact_email') }}" target="_blank"><i class="bi bi-envelope"></i></a>
        </div>
    </div>
</div>
<!-- End Top Bar -->
