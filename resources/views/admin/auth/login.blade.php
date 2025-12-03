<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Ahla Finance</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Google Fonts - Inter & Nunito -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ============================================
           VARIABLES CSS - IDENTITÉ VISUELLE AHLA
           ============================================ */
        :root {
            /* Palette principale Ahla Finance */
            --ahla-blue-bright: #2E64BA;      /* Bleu vif */
            --ahla-blue-dark: #0C3260;        /* Bleu foncé */
            --ahla-blue-light: #4A8DD4;       /* Bleu clair */
            --ahla-blue-hover: #1E4A8A;       /* Bleu hover */

            /* Couleurs neutres */
            --ahla-white: #FFFFFF;
            --ahla-gray-50: #F9FAFB;
            --ahla-gray-100: #F3F4F6;
            --ahla-gray-200: #E5E7EB;
            --ahla-gray-300: #D1D5DB;
            --ahla-gray-400: #9CA3AF;
            --ahla-gray-500: #6B7280;
            --ahla-gray-600: #4B5563;
            --ahla-gray-700: #374151;
            --ahla-gray-800: #1F2937;
            --ahla-gray-900: #111827;

            /* Couleurs système */
            --ahla-success: #10B981;
            --ahla-warning: #F59E0B;
            --ahla-danger: #EF4444;
            --ahla-info: #3B82F6;

            /* Layout */
            --border-radius: 12px;
            --border-radius-lg: 16px;
            --shadow-sm: 0 2px 8px rgba(46, 100, 186, 0.06);
            --shadow-md: 0 4px 16px rgba(46, 100, 186, 0.08);
            --shadow-lg: 0 8px 24px rgba(46, 100, 186, 0.12);
        }

        /* ============================================
           RESET & BASE
           ============================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Nunito', 'Lato', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: var(--ahla-gray-800);
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-dark) 100%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            overflow-x: hidden;
        }

        /* ============================================
           CONTAINER LOGIN
           ============================================ */
        .login-container {
            width: 100%;
            max-width: 440px;
            animation: fadeIn 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 4rem);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ============================================
           CARD LOGIN
           ============================================ */
        .login-card {
            background: var(--ahla-white);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            padding: 3rem 2.5rem;
            width: 100%;
            backdrop-filter: blur(10px);
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .login-container {
                min-height: calc(100vh - 2rem);
            }
        }

        /* ============================================
           HEADER LOGIN
           ============================================ */
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-logo {
            width: auto;
            height: 70px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-logo img {
            max-width: 100%;
            max-height: 70px;
            height: auto;
            object-fit: contain;
        }

        .login-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--ahla-blue-dark);
            margin-bottom: 0.5rem;
            font-family: 'Inter', sans-serif;
        }

        .login-header p {
            font-size: 0.95rem;
            color: var(--ahla-gray-600);
            margin: 0;
            font-weight: 500;
        }

        /* ============================================
           FORM STYLES
           ============================================ */
        .form-label {
            font-weight: 600;
            color: var(--ahla-gray-700);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            text-align: center;
            display: block;
            width: 100%;
        }

        .input-group-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .input-group-wrapper .input-group {
            width: 100%;
            max-width: 100%;
            display: flex;
            align-items: stretch;
        }

        .form-control {
            border: 2px solid var(--ahla-gray-200);
            border-radius: var(--border-radius);
            padding: 0.875rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: var(--ahla-white);
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            border-color: var(--ahla-blue-bright);
            box-shadow: 0 0 0 0.2rem rgba(46, 100, 186, 0.1);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: var(--ahla-danger);
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.1);
        }

        .invalid-feedback {
            font-size: 0.875rem;
            color: var(--ahla-danger);
            margin-top: 0.25rem;
        }

        .input-group-text {
            background: var(--ahla-gray-50);
            border: 2px solid var(--ahla-gray-200);
            border-right: none;
            border-radius: var(--border-radius) 0 0 var(--border-radius);
            color: var(--ahla-gray-600);
            min-width: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            flex: 1;
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--ahla-blue-bright);
            background: var(--ahla-gray-50);
        }

        .input-group:focus-within .form-control {
            border-left-color: var(--ahla-blue-bright);
        }

        /* ============================================
           CHECKBOX STYLES
           ============================================ */
        .form-check {
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-check-input {
            width: 1.125rem;
            height: 1.125rem;
            margin-top: 0.25rem;
            border: 2px solid var(--ahla-gray-300);
            border-radius: 4px;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--ahla-blue-bright);
            border-color: var(--ahla-blue-bright);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(46, 100, 186, 0.1);
        }

        .form-check-label {
            font-size: 0.9rem;
            color: var(--ahla-gray-700);
            margin-left: 0.5rem;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        /* ============================================
           BUTTON STYLES
           ============================================ */
        .btn-primary {
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-dark) 100%);
            border: none;
            border-radius: var(--border-radius);
            padding: 0.875rem 1.5rem;
            font-weight: 600;
            font-size: 1rem;
            color: var(--ahla-white);
            width: 100%;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--ahla-blue-hover) 0%, var(--ahla-blue-dark) 100%);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(46, 100, 186, 0.2);
        }

        .btn-primary i {
            font-size: 1.125rem;
        }

        /* ============================================
           ALERT STYLES
           ============================================ */
        .alert {
            border-radius: var(--border-radius);
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            box-shadow: var(--shadow-sm);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--ahla-danger);
            border-left: 3px solid var(--ahla-danger);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--ahla-success);
            border-left: 3px solid var(--ahla-success);
        }

        .alert ul {
            margin: 0.5rem 0 0 0;
            padding-left: 1.25rem;
        }

        .alert ul li {
            margin: 0.25rem 0;
        }

        .btn-close {
            opacity: 0.6;
            transition: opacity 0.2s ease;
        }

        .btn-close:hover {
            opacity: 1;
        }

        /* ============================================
           LOADING STATE
           ============================================ */
        .btn-primary.loading {
            position: relative;
            color: transparent;
            pointer-events: none;
        }

        .btn-primary.loading::after {
            content: '';
            position: absolute;
            width: 1rem;
            height: 1rem;
            top: 50%;
            left: 50%;
            margin-left: -0.5rem;
            margin-top: -0.5rem;
            border: 2px solid var(--ahla-white);
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 576px) {
            body {
                padding: 1rem;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }

            .login-logo {
                height: 60px;
            }

            .login-logo img {
                max-height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
    <div class="login-card">
        <div class="login-header">
                <div class="login-logo">
                    @php
                        $settings = \App\Models\SiteSetting::first();
                        $logoPath = $settings && $settings->logo ? (str_starts_with($settings->logo, 'storage/') ? asset('storage/' . $settings->logo) : asset($settings->logo)) : asset('images/logo.png');
                    @endphp
                    <img src="{{ $logoPath }}" alt="Ahla Finance Logo">
                </div>
                <h1>Admin Panel</h1>
                <p>Ahla Finance</p>
        </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <strong>Erreur de connexion</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

            <form method="POST" action="{{ route('admin.login.post') }}" id="loginForm">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="bi bi-envelope"></i> Email
                </label>
                <div class="input-group-wrapper">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="votre@email.com"
                            required
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                </div>
                @error('email')
                    <div class="invalid-feedback d-block text-center">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    <i class="bi bi-lock"></i> Mot de passe
                </label>
                <div class="input-group-wrapper">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        >
                    </div>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block text-center">{{ $message }}</div>
                @enderror
            </div>

                <div class="mb-4">
                    <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    Se souvenir de moi
                </label>
                    </div>
            </div>

                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Se connecter</span>
            </button>
        </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ajouter un état de chargement au bouton
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });

        // Gérer l'autofocus sur mobile
        if (window.innerWidth > 768) {
            document.getElementById('email')?.focus();
        }
    </script>
</body>
</html>
