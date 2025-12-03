<!-- Footer-Section start -->
<footer class="modern-footer">
    <!-- Section principale du footer -->
    <div class="footer-top">
        <div class="container">
            <div class="row gx-5">
                <!-- Colonne principale avec logo et newsletter -->
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="footer-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset($settings->logo ?? 'images/ft_logo.png') }}" alt="Logo">
                        </a>
                    </div>
                    <p class="footer-intro">
                        Nous créons des expériences digitales innovantes pour les entreprises visionnaires.
                    </p>
                    <div class="footer-newsletter">
                        <h5>Restez informé</h5>
                        <form id="newsletter-form-footer" method="POST" action="{{ route('newsletter.subscribe') }}">
                            @csrf
                            <div class="newsletter-box">
                                <input type="email" name="email" id="newsletter-email-footer" placeholder="Votre email" required autocomplete="email">
                                <button type="submit"><i class="icofont-paper-plane"></i></button>
                            </div>
                            <small>En vous inscrivant, vous acceptez nos conditions d'utilisation.</small>
                            <div id="newsletter-message-footer" class="mt-2"></div>
                        </form>
                    </div>
                    <script>
                        document.getElementById('newsletter-form-footer').addEventListener('submit', function(e) {
                            e.preventDefault();
                            const form = this;
                            const email = document.getElementById('newsletter-email-footer').value;
                            const messageDiv = document.getElementById('newsletter-message-footer');
                            const submitButton = form.querySelector('button[type="submit"]');

                            // Désactiver le bouton pendant l'envoi
                            submitButton.disabled = true;
                            submitButton.innerHTML = '<i class="icofont-loader"></i>';

                            // Récupérer le token CSRF
                            const csrfToken = document.querySelector('meta[name="csrf-token"]')
                                ? document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                : document.querySelector('input[name="_token"]')
                                    ? document.querySelector('input[name="_token"]').value
                                    : '';

                            // Préparer les données en format FormData
                            const formData = new FormData();
                            formData.append('email', email);
                            formData.append('_token', csrfToken);

                            fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: formData
                            })
                            .then(response => {
                                if (!response.ok) {
                                    return response.json().then(data => {
                                        throw new Error(data.message || 'Erreur lors de l\'inscription');
                                    });
                                }
                                return response.json();
                            })
                            .then(data => {
                                if(data.success) {
                                    messageDiv.innerHTML = '<div class="alert alert-success" style="font-size: 12px; padding: 8px; border-radius: 6px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb;">' + data.message + '</div>';
                                    form.reset();
                                    setTimeout(() => messageDiv.innerHTML = '', 5000);
                                } else {
                                    messageDiv.innerHTML = '<div class="alert alert-danger" style="font-size: 12px; padding: 8px; border-radius: 6px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">' + (data.message || 'Erreur lors de l\'inscription') + '</div>';
                                }
                            })
                            .catch(error => {
                                console.error('Erreur:', error);
                                messageDiv.innerHTML = '<div class="alert alert-danger" style="font-size: 12px; padding: 8px; border-radius: 6px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">' + (error.message || 'Erreur lors de l\'inscription. Veuillez réessayer.') + '</div>';
                            })
                            .finally(() => {
                                // Réactiver le bouton
                                submitButton.disabled = false;
                                submitButton.innerHTML = '<i class="icofont-paper-plane"></i>';
                            });
                        });
                    </script>
                </div>

                <!-- Colonne des liens rapides -->
                <div class="col-lg-2 col-md-4 col-6 mb-4 mb-md-0">
                    <h5 class="footer-title">Navigation</h5>
                    <ul class="footer-menu">
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="{{ route('page', 'a-propos') }}">À propos</a></li>
                        <li><a href="{{ route('page', 'faq') }}">FAQ</a></li>
                        <li><a href="{{ route('page', 'contact') }}">Contact</a></li>
                    </ul>
                </div>

                <!-- Colonne des pages utiles -->


                <!-- Colonne contact et application -->
                <div class="col-lg-3 col-md-4">
                    <h5 class="footer-title">Contact</h5>
                    <ul class="footer-contact">
                        <li>
                            <span class="icon"><i class="icofont-envelope"></i></span>
                            <a href="mailto:{{ $settings->email ?? 'contact@ahla-finance.com' }}">{{ $settings->email ?? 'contact@ahla-finance.com' }}</a>
                        </li>
                        <li>
                            <span class="icon"><i class="icofont-phone"></i></span>
                            <a href="tel:{{ $settings->phone ?? '+23561750707' }}">{{ $settings->phone ?? '+235 61 75 07 07' }}</a>
                        </li>
                    </ul>

                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4 mb-md-0">
                    <h5 class="footer-title">Application Mobile</h5>
                    <div class="footer-app">
                        @php
                            $androidLink = \App\Models\DownloadLink::active()->where('platform', 'android')->first();
                            $iosLink = \App\Models\DownloadLink::active()->where('platform', 'ios')->first();
                        @endphp
                        <a href="{{ $androidLink->url ?? '#' }}" class="app-badge">
                            <img src="{{ asset($androidLink->icon ?? 'images/googleplay.png') }}" alt="Google Play">
                        </a>
                        <a href="{{ $iosLink->url ?? '#' }}" class="app-badge">
                            <img src="{{ asset($iosLink->icon ?? 'images/appstorebtn.png') }}" alt="App Store">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section inférieure du footer -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="copyright">
                        <p>© 2025 Tous droits réservés</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="social-links">
                        <a href="{{ $settings->facebook_url ?? '#' }}"><i class="icofont-facebook"></i></a>
                        <a href="{{ $settings->twitter_url ?? '#' }}"><i class="icofont-twitter"></i></a>
                        <a href="{{ $settings->instagram_url ?? '#' }}"><i class="icofont-instagram"></i></a>
                        <a href="{{ $settings->pinterest_url ?? '#' }}"><i class="icofont-pinterest"></i></a>
                        <a href="{{ $settings->linkedin_url ?? '#' }}"><i class="icofont-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-credits">
                        <p>By<a href="https://itea.africa" target="_blank">iTEA</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer-Section end -->

