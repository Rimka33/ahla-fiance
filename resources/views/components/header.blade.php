<!-- Header Start -->
<header>
    <!-- container start -->
    <div class="container">
        <!-- navigation bar -->
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset($settings->logo ?? 'images/logo.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
            <!-- <i class="icofont-navigation-menu ico_menu"></i> -->
            <span class="toggle-wrap">
              <span class="toggle-bar"></span>
            </span>
          </span>
        </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @php
                        $currentRoute = request()->route()->getName();
                        $isHome = $currentRoute === 'home';
                        $isPage = $currentRoute === 'page';
                        $isNews = in_array($currentRoute, ['news.index', 'news.show']);
                        // Le paramètre 'page' peut être un objet Page ou une chaîne (slug)
                        $pageParam = request()->route('page');
                        $currentSlug = $isPage ? (is_object($pageParam) ? $pageParam->slug : $pageParam) : null;
                    @endphp
                    <li class="nav-item {{ $isHome ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">Accueil</a>
                    </li>
                    <li class="nav-item {{ ($isPage && $currentSlug === 'a-propos') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('page', 'a-propos') }}">À Propos</a>
                    </li>
                    <li class="nav-item {{ $isNews ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('news.index') }}">Actualités</a>
                    </li>
                    <!-- secondery menu start -->

                    <!-- secondery menu end -->

                    <li class="nav-item {{ ($isPage && $currentSlug === 'faq') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('page', 'faq') }}">FAQ</a>
                    </li>
                    <li class="nav-item {{ ($isPage && $currentSlug === 'contact') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('page', 'contact') }}">Contact</a>
                    </li>

                    <li class="nav-item">
                        <div class="btn_block">
                            @php
                                $downloadLink = \App\Models\DownloadLink::active()->whereIn('platform', ['android', 'ios'])->first();
                            @endphp
                            <a class="nav-link dark_btn" href="{{ $downloadLink->url ?? '#' }}">Téléchargez</a>
                            <div class="btn_bottom"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- navigation end -->
    </div>
    <!-- container end -->
</header>

