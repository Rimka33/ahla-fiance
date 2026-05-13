<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin — Ahla Finance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue-bright: #2E64BA;
            --blue-dark:   #0C3260;
            --blue-light:  #4A8DD4;
            --blue-soft:   #EEF4FF;
            --white:       #FFFFFF;
            --gray-50:     #F9FAFB;
            --gray-100:    #F3F4F6;
            --gray-200:    #E5E7EB;
            --gray-300:    #D1D5DB;
            --gray-400:    #9CA3AF;
            --gray-500:    #6B7280;
            --gray-600:    #4B5563;
            --gray-700:    #374151;
            --gray-800:    #1F2937;
            --gray-900:    #111827;
            --danger:      #EF4444;
            --success:     #10B981;
            --radius:      14px;
            --radius-sm:   8px;
            --shadow:      0 20px 60px rgba(12, 50, 96, 0.18);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--blue-dark) 0%, #1a4a8a 50%, var(--blue-bright) 100%);
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Décorations de fond */
        body::before, body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
        }
        body::before {
            width: 500px; height: 500px;
            top: -150px; right: -150px;
            background: rgba(74, 141, 212, 0.15);
        }
        body::after {
            width: 400px; height: 400px;
            bottom: -100px; left: -100px;
            background: rgba(255, 255, 255, 0.05);
        }

        /* ── CARD ── */
        .login-card {
            width: 100%;
            max-width: 440px;
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            animation: slideUp 0.45s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            z-index: 1;
            padding: 2.5rem 2.5rem 2.25rem;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0)   scale(1); }
        }

        /* ── HEADER CARD ── */
        .card-top {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-wrap {
            width: 80px; height: 80px;
            margin: 0 auto 1.25rem;
            background: var(--blue-soft);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid var(--gray-200);
        }

        .logo-wrap img {
            max-width: 58px;
            max-height: 58px;
            object-fit: contain;
        }

        .card-top h1 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--blue-dark);
            margin-bottom: 0.25rem;
        }

        .card-top p {
            font-size: 0.875rem;
            color: var(--gray-500);
            font-weight: 400;
        }

        /* ── BODY ── */
        .card-body-inner {
            /* intégré dans .login-card directement */
        }

        @media (max-width: 480px) {
            .login-card { padding: 2rem 1.5rem 1.75rem; }
        }

        /* ── ALERTS ── */
        .alert {
            border-radius: var(--radius-sm);
            border: none;
            padding: 0.875rem 1rem;
            margin-bottom: 1.25rem;
            font-size: 0.875rem;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }
        .alert i { flex-shrink: 0; font-size: 1rem; margin-top: 0.05rem; }
        .alert-danger  { background: #FEF2F2; color: #B91C1C; border-left: 3px solid var(--danger); }
        .alert-success { background: #ECFDF5; color: #065F46; border-left: 3px solid var(--success); }
        .alert ul { margin: 0.25rem 0 0 0; padding-left: 1rem; }
        .alert .btn-close { margin-left: auto; flex-shrink: 0; opacity: 0.5; }
        .alert .btn-close:hover { opacity: 1; }

        /* ── FORM ── */
        .field-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 0.4rem;
            display: block;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrap .input-icon {
            position: absolute;
            left: 0.875rem;
            color: var(--gray-400);
            font-size: 1rem;
            pointer-events: none;
            z-index: 2;
        }

        .input-wrap input {
            width: 100%;
            height: 46px;
            padding: 0 1rem 0 2.625rem;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            color: var(--gray-800);
            background: var(--gray-50);
            transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
            font-family: 'Inter', sans-serif;
        }

        .input-wrap input:focus {
            outline: none;
            border-color: var(--blue-bright);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(46, 100, 186, 0.12);
        }

        .input-wrap input.is-invalid {
            border-color: var(--danger);
            background: #FEF2F2;
        }

        .input-wrap input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }

        /* Bouton show/hide mot de passe */
        .toggle-pass {
            position: absolute;
            right: 0.75rem;
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            padding: 0.25rem;
            font-size: 1rem;
            line-height: 1;
            transition: color 0.15s;
            z-index: 2;
        }
        .toggle-pass:hover { color: var(--blue-bright); }

        .invalid-msg {
            font-size: 0.78rem;
            color: var(--danger);
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* ── REMEMBER ── */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 1rem 0 1.5rem;
        }

        .remember-row input[type="checkbox"] {
            width: 17px;
            height: 17px;
            border: 1.5px solid var(--gray-300);
            border-radius: 4px;
            cursor: pointer;
            accent-color: var(--blue-bright);
            flex-shrink: 0;
        }

        .remember-row label {
            font-size: 0.875rem;
            color: var(--gray-600);
            cursor: pointer;
            user-select: none;
            font-weight: 500;
        }

        /* ── BOUTON ── */
        .btn-login {
            width: 100%;
            height: 48px;
            background: linear-gradient(135deg, var(--blue-bright) 0%, var(--blue-dark) 100%);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: opacity 0.15s, transform 0.15s, box-shadow 0.15s;
            box-shadow: 0 4px 14px rgba(46, 100, 186, 0.35);
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.01em;
        }

        .btn-login:hover  { opacity: 0.92; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(46, 100, 186, 0.4); }
        .btn-login:active { transform: translateY(0); }
        .btn-login:disabled { opacity: 0.65; cursor: not-allowed; transform: none; }

        /* Spinner état chargement */
        .btn-login .spinner {
            display: none;
            width: 18px; height: 18px;
            border: 2px solid rgba(255,255,255,0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        .btn-login.loading .spinner  { display: block; }
        .btn-login.loading .btn-text { display: none; }
        .btn-login.loading .btn-icon { display: none; }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── PIED ── */
        .card-footer-note {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--gray-100);
        }

        .card-footer-note p {
            font-size: 0.75rem;
            color: var(--gray-400);
        }

        .card-footer-note strong {
            color: var(--gray-500);
        }
    </style>
</head>
<body>

<div class="login-card">

    {{-- ── EN-TÊTE ── --}}
    <div class="card-top">
        <div class="logo-wrap">
            @php
                $settings = \App\Models\SiteSetting::first();
                $logoPath = $settings && $settings->logo
                    ? (str_starts_with($settings->logo, 'storage/') ? asset('storage/' . $settings->logo) : asset($settings->logo))
                    : asset('images/logo.png');
            @endphp
            <img src="{{ $logoPath }}" alt="Ahla Finance">
        </div>
        <h1>Admin Panel</h1>
        <p>Ahla Finance · Espace d'administration</p>
    </div>

    {{-- ── FORMULAIRE ── --}}
    <div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div>
                    <strong>Erreur de connexion</strong>
                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" id="loginForm" novalidate>
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label class="field-label" for="email">Email</label>
                <div class="input-wrap">
                    <i class="bi bi-envelope input-icon"></i>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@ahla.com"
                        autocomplete="email"
                        autofocus
                        class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        required
                    >
                </div>
                @error('email')
                    <div class="invalid-msg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Mot de passe --}}
            <div class="mb-0">
                <label class="field-label" for="password">Mot de passe</label>
                <div class="input-wrap">
                    <i class="bi bi-lock input-icon"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                        required
                    >
                    <button type="button" class="toggle-pass" id="togglePass" title="Afficher / masquer">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-msg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Se souvenir de moi --}}
            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Se souvenir de moi</label>
            </div>

            {{-- Bouton --}}
            <button type="submit" class="btn-login" id="submitBtn">
                <i class="bi bi-box-arrow-in-right btn-icon"></i>
                <span class="btn-text">Se connecter</span>
                <div class="spinner"></div>
            </button>
        </form>

        <div class="card-footer-note">
            <p>Accès réservé aux <strong>administrateurs</strong> Ahla Finance</p>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle visibilité mot de passe
    document.getElementById('togglePass').addEventListener('click', function () {
        var input = document.getElementById('password');
        var icon  = document.getElementById('toggleIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    });

    // État chargement au submit
    document.getElementById('loginForm').addEventListener('submit', function () {
        var btn = document.getElementById('submitBtn');
        btn.classList.add('loading');
        btn.disabled = true;
    });
</script>
</body>
</html>
