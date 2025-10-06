<div class="page-title" data-aos="fade">
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li>
                    @php
                        [$label, $url] = match(Route::currentRouteName()){
                            'profile.show' => ['Mi Perfil', route('profile.show')],
                            default => ['Blank', route('web.index')]
                        }
                    @endphp
                    <a href="{{ $url }}">{{ $label }}</a>
                </li>
                <li class="current">{{ Str::upper(auth()->user()->name) }}</li>
            </ol>
        </div>
    </nav>
</div>
