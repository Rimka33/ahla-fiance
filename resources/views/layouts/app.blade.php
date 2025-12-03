<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $settings->site_name ?? 'Ahla Finance')</title>

    <!-- icofont-css-link -->
    <link rel="stylesheet" href="{{ asset('css/icofont.min.css') }}">
    <!-- Owl-Carosal-Style-link -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <!-- Bootstrap-Style-link -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Aos-Style-link -->
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <!-- Coustome-Style-link -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive-Style-link -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset($settings->favicon ?? 'images/favicon.png') }}" type="image/x-icon">

    <!-- Balises Open Graph -->
    @if(isset($settings))
    <meta property="og:title" content="{{ $settings->meta_description ?: 'Ahla Finance Digitale' }}" />
    <meta property="og:description" content="{{ $settings->meta_description ?: 'Ahla Finance Digitale révolutionne les services financiers au Tchad : transferts d\'argent, paiements mobiles, QR code et plus, via une app simple et intuitive.' }}" />
    <meta property="og:image" content="{{ asset('images/logo_partage.png') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />

    <!-- Balise Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $settings->site_name ?: 'Ahla Finance Digitale' }}">
    <meta name="twitter:description" content="{{ $settings->meta_description ?: 'Ahla Finance Digitale révolutionne les services financiers au Tchad : transferts d\'argent, paiements mobiles, QR code et plus, via une app simple et intuitive.' }}">
    <meta name="twitter:image" content="{{ asset('images/logo_partage.png') }}">
    @endif

    @include('components.schema-org', ['settings' => $settings ?? null])

    @stack('styles')
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="loader"></div>
    </div>

    @include('components.header', ['settings' => $settings ?? null])

    @yield('content')

    @include('components.footer', ['settings' => $settings ?? null])

    <!-- go top button -->
    <div class="go_top" id="Gotop">
        <span><i class="icofont-arrow-up"></i></span>
    </div>

    <!-- Video Model Start -->
    <div class="modal fade youtube-video" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button id="close-video" type="button" class="button btn btn-default text-right" data-dismiss="modal">
                    <i class="icofont-close-line-circled"></i>
                </button>
                <div class="modal-body">
                    <div id="video-container" class="video-container">
                        <iframe id="youtubevideo" width="640" height="360" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- Video Model End -->

    <!-- Jquery-js-Link -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <!-- owl-js-Link -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- bootstrap-js-Link -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap 5 for FAQ accordion -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- aos-js-Link -->
    <script src="{{ asset('js/aos.js') }}"></script>
    <!-- Typed Js -->
    <script src="{{ asset('js/typed.min.js') }}"></script>
    <!-- main-js-Link -->
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>

