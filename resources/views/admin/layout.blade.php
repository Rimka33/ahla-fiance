<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'Admin') - Ahla Finance</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- AOS - Animate On Scroll -->
    <link href="{{ asset('css/aos.css') }}" rel="stylesheet">

    <!-- Google Fonts - Inter & Nunito -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Admin Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">

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
        --navbar-height: 70px;
        --header-height: 80px;
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
            overflow-x: hidden;
        }

        /* ============================================
           NAVBAR HORIZONTALE FIXE EN HAUT
           ============================================ */
        .navbar-horizontal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            min-height: var(--navbar-height);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.95) 100%);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(46, 100, 186, 0.1);
            box-shadow: 0 2px 20px rgba(46, 100, 186, 0.08), 0 1px 2px rgba(0, 0, 0, 0.04);
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 5rem;
            gap: 2.5rem;
            transition: all 0.3s ease;
            overflow: visible;
        }

        .navbar-horizontal::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 50%, var(--ahla-blue-dark) 100%);
        }

        /* Logo Navbar */
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: var(--ahla-blue-dark);
            font-weight: 700;
            font-size: 1.25rem;
            font-family: 'Inter', sans-serif;
            flex-shrink: 0;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .navbar-brand::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(46, 100, 186, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .navbar-brand:hover::before {
            left: 100%;
        }

        .navbar-brand:hover {
            background: rgba(46, 100, 186, 0.05);
            transform: translateX(2px);
        }

        .navbar-brand-logo {
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem;
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.1) 0%, rgba(74, 141, 212, 0.1) 100%);
            border-radius: var(--border-radius);
            border: 2px solid rgba(46, 100, 186, 0.15);
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(46, 100, 186, 0.1);
        }

        .navbar-brand:hover .navbar-brand-logo {
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.15) 0%, rgba(74, 141, 212, 0.15) 100%);
            border-color: rgba(46, 100, 186, 0.3);
            transform: scale(1.05) rotate(2deg);
            box-shadow: 0 4px 12px rgba(46, 100, 186, 0.2);
        }

        .navbar-brand-logo img {
            max-width: 100%;
            max-height: 100%;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover .navbar-brand-logo img {
            transform: scale(1.1);
        }

        .navbar-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.3;
        }

        .navbar-brand-text h4 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--ahla-blue-dark) 0%, var(--ahla-blue-bright) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover .navbar-brand-text h4 {
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-brand-text small {
            font-size: 0.7rem;
            color: var(--ahla-gray-500);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover .navbar-brand-text small {
            color: var(--ahla-blue-bright);
        }

        /* Navigation Menu */
        .navbar-menu {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            overflow-x: auto;
            overflow-y: visible;
            padding: 0 1rem;
            position: relative;
        }

        .navbar-menu::-webkit-scrollbar {
            height: 4px;
        }

        .navbar-menu::-webkit-scrollbar-track {
            background: rgba(46, 100, 186, 0.05);
            border-radius: 2px;
        }

        .navbar-menu::-webkit-scrollbar-thumb {
            background: linear-gradient(90deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 100%);
            border-radius: 2px;
        }

        .navbar-menu-item {
            position: relative;
        }

        .navbar-menu-link {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.75rem 1.25rem;
            color: var(--ahla-gray-700);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            border-radius: var(--border-radius);
            white-space: nowrap;
            position: relative;
            overflow: hidden;
        }

        .navbar-menu-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 100%);
            transition: width 0.3s ease;
            border-radius: 3px 3px 0 0;
        }

        .navbar-menu-link:hover::before,
        .navbar-menu-link.active::before {
            width: calc(100% - 1rem);
        }

        .navbar-menu-link i {
            font-size: 1.125rem;
            color: var(--ahla-gray-600);
            transition: all 0.3s ease;
        }

        .navbar-menu-link:hover {
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.08) 0%, rgba(74, 141, 212, 0.08) 100%);
            color: var(--ahla-blue-bright);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(46, 100, 186, 0.15);
        }

        .navbar-menu-link:hover i {
            color: var(--ahla-blue-bright);
            transform: scale(1.15);
        }

        .navbar-menu-link.active {
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.12) 0%, rgba(74, 141, 212, 0.12) 100%);
            color: var(--ahla-blue-bright);
            font-weight: 700;
            box-shadow: 0 2px 12px rgba(46, 100, 186, 0.2);
        }

        .navbar-menu-link.active i {
            color: var(--ahla-blue-bright);
            transform: scale(1.1);
        }

        /* Dropdown Menu */
        .navbar-dropdown {
            position: relative;
        }

        .navbar-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.75rem 1.25rem;
            color: var(--ahla-gray-700);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            border-radius: var(--border-radius);
            white-space: nowrap;
            background: none;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .navbar-dropdown-toggle::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 100%);
            transition: width 0.3s ease;
            border-radius: 3px 3px 0 0;
        }

        .navbar-dropdown-toggle:hover::before,
        .navbar-dropdown-toggle.active::before {
            width: calc(100% - 1rem);
        }

        .navbar-dropdown-toggle i:first-child {
            font-size: 1.125rem;
            color: var(--ahla-gray-600);
            transition: all 0.3s ease;
        }

        .navbar-dropdown-toggle .arrow {
            font-size: 0.75rem;
            color: var(--ahla-gray-500);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-left: 0.5rem;
        }

        .navbar-dropdown-toggle:hover {
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.08) 0%, rgba(74, 141, 212, 0.08) 100%);
            color: var(--ahla-blue-bright);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(46, 100, 186, 0.15);
        }

        .navbar-dropdown-toggle:hover i:first-child {
            color: var(--ahla-blue-bright);
            transform: scale(1.15);
        }

        .navbar-dropdown-toggle:hover .arrow {
            color: var(--ahla-blue-bright);
        }

        .navbar-dropdown-toggle.active {
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.12) 0%, rgba(74, 141, 212, 0.12) 100%);
            color: var(--ahla-blue-bright);
            font-weight: 700;
            box-shadow: 0 2px 12px rgba(46, 100, 186, 0.2);
        }

        .navbar-dropdown-toggle.active .arrow {
            transform: rotate(180deg);
            color: var(--ahla-blue-bright);
        }

        .navbar-dropdown-content {
            position: fixed;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.95) 100%);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: var(--border-radius-lg);
            box-shadow: 0 8px 32px rgba(46, 100, 186, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
            min-width: 240px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1), transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            transform: translateY(-10px);
            z-index: 10000;
            border: 1px solid rgba(46, 100, 186, 0.15);
            padding: 0;
            pointer-events: none;
            visibility: hidden;
        }

        .navbar-dropdown-content.active {
            max-height: 500px;
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 0.5rem 0;
            visibility: visible;
        }

        .navbar-dropdown-content a {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.875rem 1.25rem;
            color: var(--ahla-gray-700);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            position: relative;
            margin: 0.125rem 0.5rem;
            border-radius: var(--border-radius);
        }

        .navbar-dropdown-content a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 100%);
            border-radius: 0 3px 3px 0;
            transition: height 0.3s ease;
        }

        .navbar-dropdown-content a:hover::before,
        .navbar-dropdown-content a.active::before {
            height: 70%;
        }

        .navbar-dropdown-content a i {
            font-size: 1.125rem;
            color: var(--ahla-gray-600);
            width: 22px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .navbar-dropdown-content a:hover {
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.1) 0%, rgba(74, 141, 212, 0.1) 100%);
            color: var(--ahla-blue-bright);
            transform: translateX(4px);
            box-shadow: 0 2px 8px rgba(46, 100, 186, 0.15);
        }

        .navbar-dropdown-content a:hover i {
            color: var(--ahla-blue-bright);
            transform: scale(1.15);
        }

        .navbar-dropdown-content a.active {
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.15) 0%, rgba(74, 141, 212, 0.15) 100%);
            color: var(--ahla-blue-bright);
            font-weight: 700;
            box-shadow: 0 2px 12px rgba(46, 100, 186, 0.2);
        }

        .navbar-dropdown-content a.active i {
            color: var(--ahla-blue-bright);
            transform: scale(1.1);
        }

        /* Menu Badge */
        .menu-badge {
            background: linear-gradient(135deg, var(--ahla-danger) 0%, #DC2626 100%);
            color: var(--ahla-white);
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.2rem 0.45rem;
            border-radius: 10px;
            margin-left: auto;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.3);
        }

        /* Navbar Actions */
        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-shrink: 0;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.625rem 1.25rem;
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.05) 0%, rgba(99, 102, 241, 0.05) 100%);
            border-radius: var(--border-radius-lg);
            border: 2px solid rgba(46, 100, 186, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .navbar-user:hover {
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.1) 0%, rgba(99, 102, 241, 0.1) 100%);
            border-color: rgba(46, 100, 186, 0.3);
            box-shadow: 0 4px 16px rgba(46, 100, 186, 0.2);
            transform: translateY(-2px);
        }

        .navbar-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 50%, var(--ahla-blue-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ahla-white);
            font-weight: 800;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(46, 100, 186, 0.3);
            transition: all 0.3s ease;
        }

        .navbar-user:hover .navbar-user-avatar {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 6px 20px rgba(46, 100, 186, 0.4);
        }

        .navbar-user-details {
            display: flex;
            flex-direction: column;
            line-height: 1.3;
        }

        .navbar-user-details div {
            font-weight: 700;
            color: var(--ahla-gray-900);
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            transition: color 0.3s ease;
        }

        .navbar-user:hover .navbar-user-details div {
            color: var(--ahla-blue-bright);
        }

        .navbar-user-details small {
            color: var(--ahla-gray-500);
            font-size: 0.75rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .navbar-user:hover .navbar-user-details small {
            color: var(--ahla-blue-bright);
        }

        .navbar-logout {
            padding: 0.75rem 1.5rem;
            background: transparent;
            border: 2px solid rgba(239, 68, 68, 0.3);
            color: var(--ahla-danger);
            border-radius: var(--border-radius);
            font-weight: 700;
            font-size: 0.875rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 0.625rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .navbar-logout::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: var(--ahla-danger);
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
            z-index: -1;
        }

        .navbar-logout:hover::before {
            width: 300px;
            height: 300px;
        }

        .navbar-logout:hover {
            color: var(--ahla-white);
            border-color: var(--ahla-danger);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
        }

        .navbar-logout i {
            transition: transform 0.3s ease;
        }

        .navbar-logout:hover i {
            transform: translateX(2px) rotate(-10deg);
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 100%);
            border: none;
            color: var(--ahla-white);
            padding: 0.75rem;
            border-radius: var(--border-radius);
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(46, 100, 186, 0.3);
            position: relative;
            overflow: hidden;
        }

        .mobile-menu-toggle::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
        }

        .mobile-menu-toggle:hover::before {
            width: 200px;
            height: 200px;
        }

        .mobile-menu-toggle:hover {
            background: linear-gradient(135deg, var(--ahla-blue-dark) 0%, var(--ahla-blue-hover) 100%);
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(46, 100, 186, 0.4);
        }

        .mobile-menu-toggle:active {
            transform: scale(0.95);
        }

        /* ============================================
           MAIN CONTENT
           ============================================ */
        .main-content {
            margin-top: var(--navbar-height);
            min-height: calc(100vh - var(--navbar-height));
            background: var(--ahla-gray-50);
            width: 100%;
        }

        /* Header principal */
        .navbar-custom {
            background: var(--ahla-white);
            padding: 2rem 2.5rem;
            box-shadow: var(--shadow-sm);
            border-bottom: 1px solid var(--ahla-gray-200);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-custom h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.75rem;
            color: var(--ahla-gray-900);
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.3px;
        }

        .breadcrumb-nav {
            margin-top: 0.75rem;
            font-size: 0.875rem;
            color: var(--ahla-gray-500);
            font-weight: 500;
        }

        .breadcrumb-nav a {
            color: var(--ahla-blue-bright);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .breadcrumb-nav a:hover {
            color: var(--ahla-blue-dark);
        }

        .breadcrumb-nav .separator {
            margin: 0 0.5rem;
            color: var(--ahla-gray-400);
        }

        /* User Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1.25rem;
            background: var(--ahla-gray-50);
            border-radius: var(--border-radius-lg);
            border: 1px solid var(--ahla-gray-200);
            transition: all 0.2s ease;
        }

        .user-info:hover {
            box-shadow: var(--shadow-sm);
            border-color: var(--ahla-blue-light);
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ahla-white);
            font-weight: 700;
            font-size: 1rem;
        }

        .user-details div:first-child {
            font-weight: 600;
            color: var(--ahla-gray-900);
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
        }

        .user-details small {
            color: var(--ahla-gray-500);
            font-size: 0.8rem;
        }

        /* Content Wrapper */
        .content-wrapper {
            padding: 1.5rem !important;
            max-width: 1400px !important;
            margin: 0 auto !important;
        }

        /* Override Bootstrap margin-bottom pour mb-4 */
        .content-wrapper .mb-4 {
            margin-bottom: 1.25rem !important;
        }

        /* ============================================
           CARDS ÉPURÉES - TAILLE RÉDUITE
           Override Bootstrap avec spécificité élevée
           ============================================ */
        .content-wrapper .card {
            border: none !important;
            border-radius: var(--border-radius) !important;
            background: var(--ahla-white) !important;
            box-shadow: var(--shadow-sm) !important;
            margin-bottom: 1.25rem !important;
            transition: all 0.3s ease !important;
            overflow: hidden !important;
            border: 1px solid var(--ahla-gray-200) !important;
        }

        .content-wrapper .card:hover {
            box-shadow: var(--shadow-md) !important;
            transform: translateY(-1px) !important;
            border-color: var(--ahla-blue-light) !important;
        }

        .content-wrapper .card-header {
            background: var(--ahla-gray-50) !important;
            border-bottom: 1px solid var(--ahla-gray-200) !important;
            padding: 1rem 1.25rem !important;
        }

        .content-wrapper .card-header h5 {
            margin: 0 !important;
            font-weight: 600 !important;
            color: var(--ahla-gray-900) !important;
            font-size: 1rem !important;
            display: flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            font-family: 'Inter', sans-serif !important;
        }

        .content-wrapper .card-header h5 i {
            color: var(--ahla-blue-bright) !important;
            font-size: 1.125rem !important;
        }

        .content-wrapper .card-body {
            padding: 1.25rem !important;
        }

        /* Stats Cards - Taille réduite */
        /* ============================================
           GRID DES STATISTIQUES
           ============================================ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: var(--ahla-white);
            border-radius: var(--border-radius);
            padding: 1.25rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            border: 1px solid var(--ahla-gray-200);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .stat-label {
            color: var(--ahla-gray-600);
            margin: 0;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'Inter', sans-serif;
        }

        .stat-header .icon-flat {
            font-size: 1.75rem;
            color: var(--ahla-blue-bright);
            opacity: 0.6;
        }

        .stat-value {
            font-size: 2.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 50%, var(--ahla-blue-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0.5rem 0;
            line-height: 1.2;
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.02em;
        }

        .stat-sublabel {
            color: var(--ahla-gray-500);
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 0.25rem;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
            border-color: var(--ahla-blue-light);
        }

        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 50%, var(--ahla-blue-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0.25rem 0;
            line-height: 1.2;
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.02em;
        }

        .stat-card p {
            color: var(--ahla-gray-600);
            margin: 0;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'Inter', sans-serif;
        }

        .stat-card small {
            color: var(--ahla-gray-500);
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* Statistiques avec gradient bleu */
        .stat-card.stat-gradient {
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.05) 0%, rgba(74, 141, 212, 0.05) 50%, rgba(12, 50, 96, 0.05) 100%);
            position: relative;
            border-left: none;
        }

        .stat-card.stat-gradient::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 50%, var(--ahla-blue-dark) 100%);
            border-radius: var(--border-radius) 0 0 var(--border-radius);
        }

        .stat-card.stat-gradient:hover {
            background: linear-gradient(135deg, rgba(46, 100, 186, 0.08) 0%, rgba(74, 141, 212, 0.08) 50%, rgba(12, 50, 96, 0.08) 100%);
        }

        /* Stats style fintech - gros et gras (taille réduite) */
        .stat-fintech {
            font-size: 2.75rem;
            font-weight: 800;
            line-height: 1;
            margin: 0;
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.03em;
        }

        .stat-fintech-number {
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-light) 50%, var(--ahla-blue-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-fintech-label {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--ahla-gray-600);
            margin-top: 0.5rem;
            font-family: 'Inter', sans-serif;
        }

        /* ============================================
           BOUTONS AHLA
           ============================================ */
        .btn-primary {
            background: var(--ahla-blue-bright);
            border: none;
            color: var(--ahla-white);
            font-weight: 600;
            padding: 0.875rem 2rem;
            border-radius: var(--border-radius);
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
            font-family: 'Inter', sans-serif;
        }

        .btn-primary:hover {
            background: var(--ahla-blue-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            color: var(--ahla-white);
        }

        .btn-outline-primary {
            border: 2px solid var(--ahla-blue-bright);
            color: var(--ahla-blue-bright);
            font-weight: 600;
            padding: 0.75rem 1.75rem;
            border-radius: var(--border-radius);
            background: transparent;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-outline-primary:hover {
            background: var(--ahla-blue-bright);
            color: var(--ahla-white);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        /* Amélioration visibilité boutons outline-primary - icônes plus grandes */
        .btn-outline-primary i,
        .btn-outline-primary i.bi {
            font-size: 1.125rem;
            font-weight: 600;
            color: #2E64BA !important;
        }

        .btn-outline-primary:hover i,
        .btn-outline-primary:hover i.bi {
            color: #FFFFFF !important;
        }

        /* Force la couleur des icônes pour tous les boutons outline */

        .btn-outline-danger i,
        .btn-outline-danger i.bi {
            color: #EF4444 !important;
        }

        .btn-outline-danger:hover i,
        .btn-outline-danger:hover i.bi {
            color: #FFFFFF !important;
        }

        .btn-outline-info i,
        .btn-outline-info i.bi {
            color: #3B82F6 !important;
        }

        .btn-outline-info:hover i,
        .btn-outline-info:hover i.bi {
            color: #FFFFFF !important;
        }

        .btn-outline-success i,
        .btn-outline-success i.bi {
            color: #10B981 !important;
        }

        .btn-outline-success:hover i,
        .btn-outline-success:hover i.bi {
            color: #FFFFFF !important;
        }

        .btn-outline-warning i,
        .btn-outline-warning i.bi {
            color: #F59E0B !important;
        }

        .btn-outline-warning:hover i,
        .btn-outline-warning:hover i.bi {
            color: #FFFFFF !important;
        }

        .btn-outline-secondary i,
        .btn-outline-secondary i.bi {
            color: #6B7280 !important;
        }

        .btn-outline-secondary:hover i,
        .btn-outline-secondary:hover i.bi {
            color: #FFFFFF !important;
        }

        .btn-success {
            background: var(--ahla-success);
            border: none;
            color: var(--ahla-white);
            font-weight: 600;
            padding: 0.875rem 2rem;
            border-radius: var(--border-radius);
            transition: all 0.2s ease;
        }

        .btn-success:hover {
            background: #059669;
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
            color: var(--ahla-white);
        }

        .btn-danger {
            background: var(--ahla-danger);
            border: none;
            color: var(--ahla-white);
            font-weight: 600;
            padding: 0.875rem 2rem;
            border-radius: var(--border-radius);
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            background: #DC2626;
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
            color: var(--ahla-white);
        }

        .btn-secondary {
            background: var(--ahla-gray-200);
            border: none;
            color: var(--ahla-gray-700);
            font-weight: 600;
            padding: 0.875rem 2rem;
            border-radius: var(--border-radius);
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: var(--ahla-gray-300);
            transform: translateY(-1px);
            color: var(--ahla-gray-800);
        }

        /* ============================================
           BOUTONS OUTLINE - VISIBILITÉ AMÉLIORÉE
           ============================================ */
        .btn-outline-danger {
            border: 2px solid var(--ahla-danger);
            color: var(--ahla-danger);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            background: transparent;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-outline-danger:hover {
            background: var(--ahla-danger);
            color: var(--ahla-white);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-outline-info {
            border: 2px solid var(--ahla-info);
            color: var(--ahla-info);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            background: transparent;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-outline-info:hover {
            background: var(--ahla-info);
            color: var(--ahla-white);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-outline-success {
            border: 2px solid var(--ahla-success);
            color: var(--ahla-success);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            background: transparent;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-outline-success:hover {
            background: var(--ahla-success);
            color: var(--ahla-white);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-outline-warning {
            border: 2px solid var(--ahla-warning);
            color: var(--ahla-warning);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            background: transparent;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-outline-warning:hover {
            background: var(--ahla-warning);
            color: var(--ahla-white);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-outline-secondary {
            border: 2px solid var(--ahla-gray-400);
            color: var(--ahla-gray-700);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            background: transparent;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-outline-secondary:hover {
            background: var(--ahla-gray-400);
            color: var(--ahla-white);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        /* ============================================
           BOUTONS SMALL - VISIBILITÉ AMÉLIORÉE
           ============================================ */
        .btn-sm {
            padding: 0.5rem 0.875rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: var(--border-radius);
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.375rem;
        }

        .btn-sm.btn-outline-primary {
            border: 2px solid var(--ahla-blue-bright);
            color: var(--ahla-blue-bright) !important;
            background: rgba(46, 100, 186, 0.05) !important;
            padding: 0.5rem 0.875rem;
            min-width: 40px;
            font-weight: 600;
        }

        .btn-sm.btn-outline-primary:hover {
            background: var(--ahla-blue-bright) !important;
            color: var(--ahla-white) !important;
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-sm.btn-outline-primary i {
            font-size: 1.125rem;
            color: #2E64BA !important;
            font-weight: 700;
        }

        .btn-sm.btn-outline-primary:hover i {
            color: #FFFFFF !important;
        }

        .btn-sm.btn-outline-danger {
            border: 2px solid var(--ahla-danger);
            color: var(--ahla-danger) !important;
            background: rgba(239, 68, 68, 0.05) !important;
            padding: 0.5rem 0.875rem;
            min-width: 40px;
            font-weight: 600;
        }

        .btn-sm.btn-outline-danger:hover {
            background: var(--ahla-danger) !important;
            color: var(--ahla-white) !important;
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-sm.btn-outline-danger i {
            font-size: 1.125rem;
            color: #EF4444 !important;
            font-weight: 700;
        }

        .btn-sm.btn-outline-danger:hover i {
            color: #FFFFFF !important;
        }

        .btn-sm.btn-outline-info {
            border: 2px solid var(--ahla-info);
            color: var(--ahla-info);
            background: transparent;
            padding: 0.5rem 0.875rem;
            min-width: 38px;
            font-weight: 600;
        }

        .btn-sm.btn-outline-info:hover {
            background: var(--ahla-info);
            color: var(--ahla-white);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-sm.btn-outline-info i {
            font-size: 1rem;
        }

        .btn-sm.btn-outline-success {
            border: 2px solid var(--ahla-success);
            color: var(--ahla-success);
            background: transparent;
            padding: 0.5rem 0.875rem;
            min-width: 38px;
            font-weight: 600;
        }

        .btn-sm.btn-outline-success:hover {
            background: var(--ahla-success);
            color: var(--ahla-white);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-sm.btn-outline-success i {
            font-size: 1rem;
        }

        .btn-sm.btn-outline-warning {
            border: 2px solid var(--ahla-warning);
            color: var(--ahla-warning);
            background: transparent;
            padding: 0.5rem 0.875rem;
            min-width: 38px;
            font-weight: 600;
        }

        .btn-sm.btn-outline-warning:hover {
            background: var(--ahla-warning);
            color: var(--ahla-white);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-sm.btn-outline-warning i {
            font-size: 1rem;
        }

        .btn-sm.btn-outline-secondary {
            border: 2px solid var(--ahla-gray-400);
            color: var(--ahla-gray-700);
            background: transparent;
            padding: 0.5rem 0.875rem;
            min-width: 38px;
            font-weight: 600;
        }

        .btn-sm.btn-outline-secondary:hover {
            background: var(--ahla-gray-400);
            color: var(--ahla-white);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-sm.btn-outline-secondary i {
            font-size: 1rem;
        }

        /* Groupe de boutons Actions - Espacement amélioré */
        .btn-group .btn-sm {
            margin: 0 2px;
        }

        .btn-group .btn-sm:first-child {
            margin-left: 0;
        }

        .btn-group .btn-sm:last-child {
            margin-right: 0;
        }

        /* ============================================
           BOUTONS DANS LES TABLES - VISIBILITÉ OPTIMALE
           ============================================ */
        table .btn-sm.btn-outline-primary {
            border: 2px solid var(--ahla-blue-bright) !important;
            color: var(--ahla-blue-bright) !important;
            background: rgba(46, 100, 186, 0.08) !important;
            min-width: 42px;
            padding: 0.625rem 0.875rem;
            font-weight: 700;
        }

        table .btn-sm.btn-outline-primary:hover {
            background: var(--ahla-blue-bright) !important;
            color: var(--ahla-white) !important;
            border-color: var(--ahla-blue-bright) !important;
        }

        table .btn-sm.btn-outline-primary i,
        table .btn-sm.btn-outline-primary i.bi {
            font-size: 1.2rem !important;
            color: #2E64BA !important;
            font-weight: 700;
        }

        table .btn-sm.btn-outline-primary:hover i,
        table .btn-sm.btn-outline-primary:hover i.bi {
            color: #FFFFFF !important;
        }

        table .btn-sm.btn-outline-danger {
            border: 2px solid var(--ahla-danger) !important;
            color: var(--ahla-danger) !important;
            background: rgba(239, 68, 68, 0.08) !important;
            min-width: 42px;
            padding: 0.625rem 0.875rem;
            font-weight: 700;
        }

        table .btn-sm.btn-outline-danger:hover {
            background: var(--ahla-danger) !important;
            color: var(--ahla-white) !important;
            border-color: var(--ahla-danger) !important;
        }

        table .btn-sm.btn-outline-danger i,
        table .btn-sm.btn-outline-danger i.bi {
            font-size: 1.2rem !important;
            color: #EF4444 !important;
            font-weight: 700;
        }

        table .btn-sm.btn-outline-danger:hover i,
        table .btn-sm.btn-outline-danger:hover i.bi {
            color: #FFFFFF !important;
        }

        table .btn-sm.btn-outline-info,
        table .btn-sm.btn-outline-success,
        table .btn-sm.btn-outline-warning {
            min-width: 42px;
            padding: 0.625rem 0.875rem;
            font-weight: 700;
            border-width: 2px;
        }

        table .btn-sm.btn-outline-info i,
        table .btn-sm.btn-outline-success i,
        table .btn-sm.btn-outline-warning i {
            font-size: 1.2rem !important;
            color: inherit !important;
            font-weight: 700;
        }

        /* Colonne Actions dans les tableaux */
        table th:last-child,
        table td:last-child {
            white-space: nowrap;
            text-align: center;
        }

        table .btn-group {
            display: inline-flex;
            gap: 0.25rem;
        }

        /* ============================================
           FORMULAIRES
           ============================================ */
        .form-control,
        .form-select {
            border-radius: var(--border-radius);
            border: 2px solid var(--ahla-gray-200);
            padding: 0.875rem 1.25rem;
            transition: all 0.2s ease;
            background: var(--ahla-white);
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--ahla-blue-bright);
            box-shadow: 0 0 0 4px rgba(46, 100, 186, 0.1);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            color: var(--ahla-gray-700);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
        }

        /* ============================================
           ALERTES / NOTIFICATIONS
           ============================================ */
        .alert {
            border-radius: var(--border-radius-lg);
            border: none;
            padding: 1.25rem 1.75rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
            box-shadow: var(--shadow-sm);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #065F46;
            border-left: 4px solid var(--ahla-success);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #991B1B;
            border-left: 4px solid var(--ahla-danger);
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            color: #1E40AF;
            border-left: 4px solid var(--ahla-info);
        }

        /* Toast Notifications */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            border: none;
        }

        /* ============================================
           TABLES
           ============================================ */
        .table {
            background: var(--ahla-white);
        }

        .table thead {
            background: var(--ahla-gray-50);
        }

        .table thead th {
            font-weight: 700;
            color: var(--ahla-gray-700);
            border-bottom: 2px solid var(--ahla-gray-200);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            font-family: 'Inter', sans-serif;
        }

        .table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid var(--ahla-gray-100);
        }

        .table tbody tr:hover {
            background: rgba(46, 100, 186, 0.03);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        /* ============================================
           BADGES
           ============================================ */
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            letter-spacing: 0.3px;
        }

        .badge.bg-success {
            background: var(--ahla-success) !important;
        }

        .badge.bg-danger {
            background: var(--ahla-danger) !important;
        }

        .badge.bg-primary {
            background: var(--ahla-blue-bright) !important;
        }

        /* ============================================
           ANIMATIONS
           ============================================ */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease;
        }

        /* ============================================
           RESPONSIVE & ACCESSIBILITÉ
           ============================================ */
        @media (max-width: 991.98px) {
            .navbar-horizontal {
                padding: 0.75rem 1rem;
                gap: 1rem;
            }

            .navbar-brand-logo {
                width: 50px;
                height: 50px;
            }

            .navbar-brand-text h4 {
                font-size: 1rem;
            }

            .navbar-menu-link,
            .navbar-dropdown-toggle {
                padding: 0.625rem 0.875rem;
                font-size: 0.85rem;
            }

            .navbar-user-avatar {
                width: 36px;
                height: 36px;
                font-size: 0.9rem;
            }

            .navbar-logout {
                padding: 0.625rem 1rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 768px) {
            .navbar-horizontal {
                height: auto;
                flex-wrap: wrap;
                padding: 0.75rem 1rem;
                gap: 0.75rem;
            }

            .navbar-brand {
                order: 1;
                flex: 0 0 auto;
            }

            .navbar-brand-logo {
                width: 45px;
                height: 45px;
            }

            .navbar-brand-text {
                display: none;
            }

            .navbar-menu {
                order: 3;
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                gap: 0.5rem;
                margin-top: 0.75rem;
                padding-top: 0.75rem;
                border-top: 1px solid var(--ahla-gray-200);
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease, padding 0.3s ease;
            }

            .navbar-menu.mobile-open {
                display: flex;
                max-height: 600px;
                padding: 0.75rem 0;
            }

            .navbar-menu-item {
                width: 100%;
            }

            .navbar-menu-link,
            .navbar-dropdown-toggle {
                width: 100%;
                justify-content: space-between;
                padding: 0.75rem 1rem;
            }

            .navbar-dropdown-content {
                position: static;
                box-shadow: none;
                border: none;
                border-top: 1px solid var(--ahla-gray-200);
                background: var(--ahla-gray-50);
                margin-top: 0.5rem;
                border-radius: 0;
            }

            .navbar-actions {
                order: 2;
                flex-direction: row;
                flex: 0 0 auto;
                width: auto;
                margin-left: auto;
                margin-top: 0;
                padding-top: 0;
                border-top: none;
                gap: 0.5rem;
            }

            .navbar-user {
                flex: 0 0 auto;
                padding: 0.5rem 0.75rem;
            }

            .navbar-user-avatar {
                width: 32px;
                height: 32px;
                font-size: 0.85rem;
            }

            .navbar-user-details {
                display: none;
            }

            .navbar-logout {
                flex-shrink: 0;
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }

            .navbar-logout span {
                display: none;
            }

            .mobile-menu-toggle {
                order: 2;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-left: auto;
            }

            .main-content {
                margin-top: 0;
            }

            .navbar-custom {
                padding: 1.5rem;
            }

            .navbar-custom h5 {
                font-size: 1.5rem;
            }

            .content-wrapper {
                padding: 1rem;
            }

            .stat-card h3 {
                font-size: 2rem;
            }

            .card-body {
                padding: 1rem;
            }

            .card-header {
                padding: 0.875rem 1rem;
            }
        }

        @media (max-width: 575.98px) {
            .navbar-horizontal {
                padding: 0.5rem 0.75rem;
            }

            .navbar-brand-logo {
                width: 40px;
                height: 40px;
            }

            .navbar-user {
                padding: 0.375rem 0.5rem;
            }

            .navbar-user-avatar {
                width: 28px;
                height: 28px;
                font-size: 0.75rem;
            }

            .navbar-logout {
                padding: 0.375rem 0.75rem;
                font-size: 0.75rem;
            }

            .mobile-menu-toggle {
                padding: 0.5rem;
                font-size: 1.25rem;
            }

            .navbar-custom {
                padding: 1rem;
            }

            .navbar-custom h5 {
                font-size: 1.25rem;
            }
        }

        @media (min-width: 769px) {
            .mobile-menu-toggle {
                display: none;
            }
        }

        /* Accessibilité - Contraste WCAG */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Focus visible pour accessibilité */
        *:focus-visible {
            outline: 2px solid var(--ahla-blue-bright);
            outline-offset: 2px;
        }

        /* ============================================
           PAGES D'ÉDITION - BOUTONS TOUJOURS VISIBLES
           ============================================ */
        .page-edit-footer {
            position: sticky;
            bottom: 0;
            background: var(--ahla-white);
            border-top: 2px solid var(--ahla-gray-200);
            padding: 1rem 1.5rem;
            margin: 1.5rem -1.5rem -1.5rem -1.5rem;
            box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.05);
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .page-edit-footer .btn-group {
            display: flex;
            gap: 1rem;
        }

        /* ============================================
           ICÔNES FLAT/OUTLINE HARMONISÉES
           ============================================ */
        .icon-flat {
            color: var(--ahla-blue-bright);
            font-size: 1.5rem;
            opacity: 0.8;
        }

        .icon-outline {
            color: var(--ahla-gray-600);
            font-size: 1.25rem;
            stroke-width: 1.5;
        }

        .icon-flat.blue { color: var(--ahla-blue-bright); }
        .icon-flat.gray { color: var(--ahla-gray-500); }
        .icon-flat.white { color: var(--ahla-white); }

        /* ============================================
           CARDS ÉDITABLES AVEC PRÉVISUALISATION - TAILLE RÉDUITE
           ============================================ */
        .edit-block-card {
            background: var(--ahla-white);
            border: 1px solid var(--ahla-gray-200);
            border-radius: var(--border-radius);
            padding: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .edit-block-card:hover {
            border-color: var(--ahla-blue-light);
            box-shadow: var(--shadow-md);
        }

        .edit-block-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--ahla-gray-200);
        }

        .edit-block-header h6 {
            margin: 0;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--ahla-gray-900);
            font-family: 'Inter', sans-serif;
        }

        .edit-block-actions {
            display: flex;
            gap: 0.5rem;
        }

        .preview-image-container {
            position: relative;
            display: inline-block;
            border-radius: var(--border-radius);
            overflow: hidden;
            border: 2px solid var(--ahla-gray-200);
            transition: all 0.3s ease;
        }

        .preview-image-container:hover {
            border-color: var(--ahla-blue-light);
            box-shadow: var(--shadow-sm);
        }

        .preview-image-container img {
            max-width: 200px;
            height: auto;
            display: block;
            border-radius: var(--border-radius);
        }

        .image-upload-wrapper {
            position: relative;
            display: inline-block;
        }

        .image-upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(46, 100, 186, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: var(--border-radius);
        }

        .image-upload-wrapper:hover .image-upload-overlay {
            opacity: 1;
        }

        .image-upload-overlay button {
            background: var(--ahla-white);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ahla-blue-bright);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .image-upload-overlay button:hover {
            transform: scale(1.1);
            background: var(--ahla-blue-bright);
            color: var(--ahla-white);
        }

        /* ============================================
           SECTION INFO - TAILLE RÉDUITE
           ============================================ */
        .section-info {
            background: rgba(46, 100, 186, 0.05);
            border-left: 3px solid var(--ahla-blue-bright);
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            display: flex;
            align-items: start;
            gap: 0.625rem;
        }

        .section-info i {
            color: var(--ahla-blue-bright);
            font-size: 1.125rem;
            margin-top: 0.125rem;
            flex-shrink: 0;
        }

        .section-info p {
            margin: 0;
            color: var(--ahla-gray-700);
            font-size: 0.875rem;
            line-height: 1.5;
        }

        /* ============================================
           CONTENT PREVIEW - TAILLE RÉDUITE
           ============================================ */
        .content-preview {
            background: var(--ahla-gray-50);
            border: 1px solid var(--ahla-gray-200);
            border-radius: var(--border-radius);
            padding: 1rem;
            margin-bottom: 0.75rem;
        }

        .content-preview-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--ahla-gray-200);
        }

        .content-preview-item:last-child {
            border-bottom: none;
        }

        /* ============================================
           AVATARS ET ICÔNES HARMONISÉES
           ============================================ */
        .avatar-outline {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 2px solid var(--ahla-blue-bright);
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--ahla-white);
            color: var(--ahla-blue-bright);
            font-weight: 600;
        }

        .avatar-flat {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ahla-white);
            font-weight: 600;
        }

        /* ============================================
           LOADER SUBTIL
           ============================================ */
        .loader-subtle {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid var(--ahla-gray-300);
            border-top-color: var(--ahla-blue-bright);
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ============================================
           BOUTONS D'ACTION DANS CARDS
           ============================================ */
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .btn-action {
            padding: 0.625rem 1.25rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-align: left;
            white-space: nowrap;
            margin: 0;
        }

        .btn-action .flex-grow-1 {
            flex: 1;
            min-width: 0;
        }

        /* Amélioration de l'espacement des boutons */
        .btn {
            margin: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            vertical-align: middle;
        }

        .btn i,
        .btn .bi {
            display: inline-flex;
            align-items: center;
            line-height: 1;
        }

        /* Espacement entre icône et texte dans les boutons */
        .btn i + span,
        .btn .bi + span,
        .btn i + *:not(i):not(.bi),
        .btn .bi + *:not(i):not(.bi) {
            margin-left: 0;
        }

        /* Espacement pour les boutons avec icônes */
        .btn i.me-1,
        .btn .bi.me-1 {
            margin-right: 0.25rem;
            margin-left: 0;
        }

        .btn i.me-2,
        .btn .bi.me-2 {
            margin-right: 0.5rem;
            margin-left: 0;
        }

        .btn i.ms-1,
        .btn .bi.ms-1 {
            margin-left: 0.25rem;
            margin-right: 0;
        }

        .btn i.ms-2,
        .btn .bi.ms-2 {
            margin-left: 0.5rem;
            margin-right: 0;
        }

        /* Alignement des boutons dans les tableaux */
        .table .btn,
        .table-responsive .btn {
            white-space: nowrap;
            vertical-align: middle;
        }

        /* Espacement des boutons dans les groupes */
        .btn-group {
            display: inline-flex;
            gap: 0.5rem;
        }

        .btn-group .btn {
            margin: 0;
        }

        /* Espacement pour les boutons dans les cartes */
        .card-header .btn,
        .card-body .btn {
            margin: 0;
        }

        .card-header .btn + .btn {
            margin-left: 0.5rem;
        }

        /* Espacement pour les boutons dans les listes */
        .list-group-item .btn {
            margin: 0;
        }

        /* Espacement vertical pour les boutons dans les divs */
        .text-center .btn,
        .d-flex .btn {
            margin: 0;
        }

        /* Espacement pour les boutons avec ms-auto, ms-3, etc. */
        .btn.ms-auto {
            margin-left: auto !important;
            margin-right: 0;
        }

        .btn.ms-1 {
            margin-left: 0.25rem !important;
            margin-right: 0;
        }

        .btn.ms-2 {
            margin-left: 0.5rem !important;
            margin-right: 0;
        }

        .btn.ms-3 {
            margin-left: 1rem !important;
            margin-right: 0;
        }

        .btn.me-1 {
            margin-right: 0.25rem !important;
            margin-left: 0;
        }

        .btn.me-2 {
            margin-right: 0.5rem !important;
            margin-left: 0;
        }

        .btn.me-3 {
            margin-right: 1rem !important;
            margin-left: 0;
        }

        .btn-action-sm {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        /* Espacement cohérent pour tous les boutons */
        .btn:not(:last-child) {
            margin-right: 0;
        }

        /* Espacement dans les flex containers */
        .d-flex .btn:not(:last-child),
        .d-inline-flex .btn:not(:last-child) {
            margin-right: 0.5rem;
        }

        /* Espacement dans les groupes de boutons */
        .btn-group > .btn:not(:first-child) {
            margin-left: 0;
        }

        /* Alignement vertical des boutons avec du texte */
        .btn {
            line-height: 1.5;
        }

        /* Espacement pour les boutons dans les cellules de tableau */
        td .btn,
        th .btn {
            margin: 0.125rem;
        }

        /* Espacement pour les boutons dans les en-têtes de cartes */
        .card-header .d-flex .btn {
            margin: 0;
        }

        .card-header .d-flex .btn:not(:first-child) {
            margin-left: 0.5rem;
        }

        /* Espacement pour les boutons dans les listes groupées */
        .list-group-item .d-flex .btn {
            margin: 0;
        }

        .list-group-item .d-flex .btn:not(:first-child) {
            margin-left: 0.5rem;
        }

        /* Correction de l'espacement pour les icônes dans les boutons */
        .btn > i:first-child:not(.me-1):not(.me-2):not(.me-3),
        .btn > .bi:first-child:not(.me-1):not(.me-2):not(.me-3) {
            margin-right: 0.5rem;
        }

        .btn > i:last-child:not(:only-child):not(.ms-1):not(.ms-2):not(.ms-3),
        .btn > .bi:last-child:not(:only-child):not(.ms-1):not(.ms-2):not(.ms-3) {
            margin-left: 0.5rem;
            margin-right: 0;
        }

        /* Espacement pour les badges dans les boutons */
        .btn .badge {
            margin-left: 0.5rem;
            margin-right: 0;
        }

        /* Correction globale du débordement des images prévisualisées */
        .img-preview,
        .img-preview-new {
            max-width: 100% !important;
            max-height: 300px !important;
            width: auto !important;
            height: auto !important;
            object-fit: contain;
            display: block;
        }

        .image-preview-container,
        .position-relative.d-inline-block {
            max-width: 100%;
            overflow: hidden;
        }

        [id$="_preview"] {
            max-width: 100%;
            overflow: hidden;
        }

        [id$="_preview"] img {
            max-width: 100% !important;
            max-height: 300px !important;
            width: auto !important;
            height: auto !important;
            object-fit: contain;
        }

        /* ============================================
           RESPONSIVE POUR PAGES D'ÉDITION
           ============================================ */
        /* ============================================
           RESPONSIVE GLOBAL
           ============================================ */
        @media (max-width: 991.98px) {
            /* Navbar Layout */
            .navbar-horizontal {
                padding: 0.5rem 1rem;
                flex-wrap: wrap;
                height: auto;
                min-height: 70px;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1030;
            }

            /* Brand */
            .navbar-brand {
                margin-right: auto;
                padding: 0.5rem 0;
            }

            .navbar-brand-text {
                display: none;
            }

            /* Mobile Menu Toggle */
            .mobile-menu-toggle {
                display: flex !important;
                align-items: center;
                justify-content: center;
                margin-left: 1rem;
                font-size: 1.5rem;
                padding: 0.5rem 0.75rem;
                border: none;
                background: linear-gradient(135deg, var(--ahla-blue-bright) 0%, var(--ahla-blue-dark) 100%);
                color: var(--ahla-white);
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-sm);
                transition: all 0.3s ease;
            }

            .mobile-menu-toggle:hover {
                background: linear-gradient(135deg, var(--ahla-blue-hover) 0%, var(--ahla-blue-dark) 100%);
                box-shadow: var(--shadow-md);
                transform: translateY(-1px);
            }

            /* Navbar Actions (User/Logout) in Mobile Menu */
            .navbar-actions {
                display: flex;
                flex-direction: column;
                width: 100%;
                margin: 0;
                padding: 0;
                border-top: 1px solid var(--ahla-gray-200);
            }

            .navbar-user,
            .navbar-logout {
                width: 100%;
                justify-content: flex-start;
                padding: 1rem;
                border-radius: 0;
                margin: 0;
            }

            .navbar-user-details,
            .navbar-logout span {
                display: block; /* Show text on mobile menu */
                margin-left: 0.5rem;
            }

            .navbar-user-details {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar-user-avatar {
                width: 32px;
                height: 32px;
                font-size: 0.8rem;
            }

            /* Navigation Menu (Hidden by default) */
            .navbar-menu {
                display: none;
                width: 100%;
                flex-direction: column;
                margin-top: 0.5rem;
                border-top: 1px solid var(--ahla-gray-200);
                background: var(--ahla-white);
                padding: 1rem 0;
                max-height: calc(100vh - 70px);
                overflow-y: auto;
            }

            /* Navigation Menu (Open) */
            .navbar-menu.mobile-open {
                display: flex;
            }

            .navbar-menu-item {
                width: 100%;
                margin: 0;
            }

            .navbar-menu-link,
            .navbar-dropdown-toggle {
                width: 100%;
                justify-content: flex-start;
                padding: 0.75rem 1rem;
                border-radius: 0;
            }

            /* Dropdowns in Mobile Menu */
            .navbar-dropdown-content {
                position: static;
                width: 100%;
                box-shadow: none;
                border: none;
                background: var(--ahla-gray-50);
                max-height: 0;
                overflow: hidden;
                opacity: 1;
                visibility: visible;
                transform: none;
                display: block;
                padding: 0;
                transition: max-height 0.3s ease;
            }

            .navbar-dropdown-content.active {
                max-height: 1000px; /* Large enough to show content */
                padding: 0.5rem 0;
            }

            /* Override inline styles from JS */
            .navbar-dropdown-content[style] {
                top: auto !important;
                left: auto !important;
            }

            .navbar-dropdown-content a {
                padding-left: 2.5rem;
                margin: 0;
            }
        }

        @media (max-width: 768px) {
            .page-edit-footer {
                flex-direction: column;
                padding: 1rem;
                margin: 1.5rem -1.5rem -1.5rem -1.5rem;
            }

            .page-edit-footer .btn-group {
                width: 100%;
                flex-direction: column;
            }

            .page-edit-footer .btn-group .btn {
                width: 100%;
            }

            .stat-fintech {
                font-size: 2.5rem;
            }

            .preview-image-container img {
                max-width: 100%;
            }

            /* Content Wrapper */
            .content-wrapper {
                padding: 1rem !important;
            }

            /* Card Headers */
            .card-header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }

            .card-header .btn,
            .card-header .btn-group {
                width: 100%;
                justify-content: center;
            }

            .card-header .d-flex {
                width: 100%;
                flex-direction: column;
                align-items: flex-start !important;
            }

            /* Filters */
            .row.g-3 .col-md-4,
            .row.g-3 .col-md-3,
            .row.g-3 .col-md-2 {
                width: 100%;
            }

            /* Tables */
            .table-responsive {
                border: 0;
                overflow-x: auto;
            }

            /* Fix button overflow in tables */
            .table .btn-group {
                flex-wrap: wrap;
            }

            .table .btn {
                font-size: 0.875rem;
                padding: 0.375rem 0.75rem;
            }

            /* Fix card button overflow */
            .card-header .btn {
                font-size: 0.875rem;
                padding: 0.5rem 1rem;
                white-space: normal;
            }

            /* Ensure buttons don't overflow in list items */
            .list-group-item .btn {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar Horizontale -->
    <nav class="navbar-horizontal">
        @php
            $settings = \App\Models\SiteSetting::first();
            $logoPath = $settings && $settings->logo ? (str_starts_with($settings->logo, 'storage/') ? asset('storage/' . $settings->logo) : asset($settings->logo)) : asset('images/logo.png');
        @endphp
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
            <div class="navbar-brand-logo">
                <img src="{{ $logoPath }}" alt="Ahla Finance Logo">
        </div>
            <div class="navbar-brand-text">
                <h4>Admin Panel</h4>
                <small>Tableau de bord</small>
            </div>
        </a>

        <div class="navbar-menu" id="navbarMenu">
            <div class="navbar-menu-item">
                <a href="{{ route('admin.dashboard') }}" class="navbar-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                    </div>

            <div class="navbar-menu-item navbar-dropdown">
                <button type="button" class="navbar-dropdown-toggle {{ request()->routeIs('admin.home-page.*') || request()->routeIs('admin.about-page.*') || request()->routeIs('admin.news.page.*') || request()->routeIs('admin.faq.page.*') || request()->routeIs('admin.contact-page.*') ? 'active' : '' }}" onclick="toggleNavDropdown(this)">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Pages</span>
                    <i class="bi bi-chevron-down arrow"></i>
                </button>
                <div class="navbar-dropdown-content">
                    <a href="{{ route('admin.home-page.edit') }}" class="{{ request()->routeIs('admin.home-page.*') ? 'active' : '' }}">
                        <i class="bi bi-house-heart"></i>
                        <span>Accueil</span>
                    </a>
                    <a href="{{ route('admin.about-page.edit') }}" class="{{ request()->routeIs('admin.about-page.*') ? 'active' : '' }}">
                        <i class="bi bi-info-circle"></i>
                        <span>À propos</span>
                    </a>
                    <a href="{{ route('admin.news.page.edit') }}" class="{{ request()->routeIs('admin.news.page.*') ? 'active' : '' }}">
                        <i class="bi bi-newspaper"></i>
                        <span>Actualités</span>
                    </a>
                    <a href="{{ route('admin.faq.page.edit') }}" class="{{ request()->routeIs('admin.faq.page.*') ? 'active' : '' }}">
                        <i class="bi bi-question-circle"></i>
                        <span>FAQ</span>
                    </a>
                    <a href="{{ route('admin.contact-page.edit') }}" class="{{ request()->routeIs('admin.contact-page.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope"></i>
                        <span>Contact</span>
                    </a>
                </div>
            </div>

            <div class="navbar-menu-item navbar-dropdown">
                <button type="button" class="navbar-dropdown-toggle {{ (request()->routeIs('admin.news.*') && !request()->routeIs('admin.news.page.*')) || (request()->routeIs('admin.faq.*') && !request()->routeIs('admin.faq.page.*')) || request()->routeIs('admin.inbox.*') || request()->routeIs('admin.newsletter.*') ? 'active' : '' }}" onclick="toggleNavDropdown(this)">
                    <i class="bi bi-collection"></i>
                    <span>Contenu</span>
                    <i class="bi bi-chevron-down arrow"></i>
                </button>
                <div class="navbar-dropdown-content">
                    <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.*') && !request()->routeIs('admin.news.page.*') ? 'active' : '' }}">
                        <i class="bi bi-newspaper"></i>
                        <span>Actualités</span>
                    </a>
                    <a href="{{ route('admin.faq.index') }}" class="{{ request()->routeIs('admin.faq.*') && !request()->routeIs('admin.faq.page.*') && !request()->routeIs('admin.inbox.*') ? 'active' : '' }}">
                        <i class="bi bi-question-circle"></i>
                        <span>FAQ</span>
                    </a>
                    <a href="{{ route('admin.inbox.index') }}" class="{{ request()->routeIs('admin.inbox.*') ? 'active' : '' }}">
                        <i class="bi bi-inbox"></i>
                        <span>Support</span>
                        @php
                            $unreadCount = \App\Models\ContactMessage::whereIn('status', ['new', 'read'])->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="menu-badge">{{ $unreadCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.newsletter.index') }}" class="{{ request()->routeIs('admin.newsletter.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope-check"></i>
                        <span>Newsletter</span>
                    </a>
            </div>
        </div>

            <div class="navbar-actions ms-auto">
            <a href="{{ route('admin.profile.edit') }}" class="navbar-user" style="text-decoration: none; color: inherit;">
                <div class="navbar-user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="navbar-user-details">
                    <div>Profil</div>
                </div>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="navbar-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
            </div>
    </div>

        <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" aria-label="Toggle menu">
            <i class="bi bi-list"></i>
        </button>
    </nav>

    <!-- Main Content -->
    <main class="main-content">

        <!-- Header -->
        <div class="navbar-custom">
            <div class="d-flex justify-content-between align-items-start">
                <div style="flex: 1;">
                    <h5>@yield('page-title', 'Tableau de Bord')</h5>
                    <div class="breadcrumb-nav">
                        <a href="{{ route('admin.dashboard') }}">Tableau de Bord</a>
                        @if(!request()->routeIs('admin.dashboard'))
                            <span class="separator">/</span>
                            <span>@yield('page-title', 'Page')</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Notifications -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show fade-in" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show fade-in" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Erreurs :</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

    <!-- Modals Stack - Rendu avant les scripts pour éviter les problèmes de positionnement -->
    @stack('modals')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- AOS Script -->
    <script src="{{ asset('js/aos.js') }}"></script>
    <script>
        // Store click timestamps to prevent hover from reopening immediately after click
        const clickTimestamps = new Map();

        // Toggle Navbar Dropdown (on click)
        function toggleNavDropdown(button) {
            const dropdown = button.nextElementSibling;
            const dropdownItem = button.closest('.navbar-dropdown');
            const isActive = dropdown.classList.contains('active');

            // Mark that we just clicked this dropdown
            if (dropdownItem) {
                clickTimestamps.set(dropdownItem, Date.now());
            }

            // If dropdown is already open, close it
            if (isActive) {
                dropdown.classList.remove('active');
                button.classList.remove('active');
            } else {
                // Close all other dropdowns first
                document.querySelectorAll('.navbar-dropdown-content').forEach(dd => {
                    dd.classList.remove('active');
                });
                document.querySelectorAll('.navbar-dropdown-toggle').forEach(btn => {
                    btn.classList.remove('active');
                });

                // Open clicked dropdown
                dropdown.classList.add('active');
                button.classList.add('active');

                // Position the dropdown using fixed positioning
                const rect = button.getBoundingClientRect();
                dropdown.style.top = (rect.bottom + 12) + 'px';
                dropdown.style.left = rect.left + 'px';
            }
        }

        // Hover functionality for dropdowns
        document.querySelectorAll('.navbar-dropdown').forEach(dropdownItem => {
            const button = dropdownItem.querySelector('.navbar-dropdown-toggle');
            const dropdown = dropdownItem.querySelector('.navbar-dropdown-content');
            let hoverTimeout;

            // Open on hover
            dropdownItem.addEventListener('mouseenter', function() {
                // Don't open if we just clicked this dropdown (within 300ms)
                const lastClickTime = clickTimestamps.get(dropdownItem);
                if (lastClickTime && (Date.now() - lastClickTime) < 300) {
                    return;
                }

                clearTimeout(hoverTimeout);

                // Close all other dropdowns
                document.querySelectorAll('.navbar-dropdown').forEach(item => {
                    if (item !== dropdownItem) {
                        const otherDropdown = item.querySelector('.navbar-dropdown-content');
                        const otherButton = item.querySelector('.navbar-dropdown-toggle');
                        otherDropdown.classList.remove('active');
                        otherButton.classList.remove('active');
                    }
                });

                // Open this dropdown
                dropdown.classList.add('active');
                button.classList.add('active');

                // Position the dropdown using fixed positioning
                const rect = button.getBoundingClientRect();
                dropdown.style.top = (rect.bottom + 12) + 'px';
                dropdown.style.left = rect.left + 'px';
            });

            // Close on mouse leave (with small delay to allow moving to dropdown)
            dropdownItem.addEventListener('mouseleave', function() {
                hoverTimeout = setTimeout(function() {
                    // Close dropdown on mouse leave, even if it has an active link
                    dropdown.classList.remove('active');
                    button.classList.remove('active');
                }, 150);
            });
        });

        // Close dropdowns when clicking on a menu item
        document.addEventListener('click', function(event) {
            // Check if clicked element is a dropdown menu link
            const clickedLink = event.target.closest('.navbar-dropdown-content a');
            if (clickedLink) {
                // Close all dropdowns
                document.querySelectorAll('.navbar-dropdown-content').forEach(dd => {
                    dd.classList.remove('active');
                });
                document.querySelectorAll('.navbar-dropdown-toggle').forEach(btn => {
                    btn.classList.remove('active');
                });
            }
        });

        // Toggle Mobile Menu
        function toggleMobileMenu() {
            const menu = document.getElementById('navbarMenu');
            menu.classList.toggle('mobile-open');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const navbar = document.querySelector('.navbar-horizontal');
            const isInDropdown = event.target.closest('.navbar-dropdown');
            const isDropdownToggle = event.target.closest('.navbar-dropdown-toggle');

            // Close all dropdowns when clicking outside the navbar or dropdown menu
            // Allow manual closure even if there's an active link
            if (navbar && !navbar.contains(event.target) && !isInDropdown && !isDropdownToggle) {
                document.querySelectorAll('.navbar-dropdown-content').forEach(dd => {
                    dd.classList.remove('active');
                });
                document.querySelectorAll('.navbar-dropdown-toggle').forEach(btn => {
                    btn.classList.remove('active');
                });
            }
        });

        // Initialize active dropdowns on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Close all dropdowns on page load by default
            // Users can manually open them if needed
            document.querySelectorAll('.navbar-dropdown-content').forEach(dropdown => {
                dropdown.classList.remove('active');
            });
            document.querySelectorAll('.navbar-dropdown-toggle').forEach(btn => {
                btn.classList.remove('active');
            });

            // Set proper max-height for remaining active dropdowns
            document.querySelectorAll('.navbar-dropdown-content.active').forEach(dropdown => {
                dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
            });

            // Initialize AOS (Animate On Scroll)
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-in-out',
                    once: true,
                    offset: 100,
                    delay: 0
                });
            }
        });

        // TinyMCE Editor
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '.wysiwyg-editor',
                height: 400,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic forecolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | link image | code | help',
                content_style: 'body { font-family: Inter, Helvetica, Arial, sans-serif; font-size:14px }',
                language: 'fr_FR',
                language_url: 'https://cdn.tiny.cloud/1/no-api-key/tinymce/6/langs/fr_FR.js'
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
