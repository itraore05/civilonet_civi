<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'État Civil CI') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --orange: #FF6B00;
            --green: #009A44;
            --blue: #0072C6;
            --white: #FFFFFF;
            --light-gray: #F5F7FA;
            --gray: #6B7280;
            --dark-gray: #374151;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-gray);
            color: var(--dark-gray);
            line-height: 1.6;
        }

        /* Styles pour la page d'authentification */
        body.auth-page {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Ajout des styles pour le formulaire à deux colonnes */
.form-row {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-column {
    flex: 1;
}

/* Ajustements pour la mise en page du formulaire */
.auth-container {
    width: 100%;
    max-width: 800px; /* Augmenter la largeur maximale pour accommoder deux colonnes */
    padding: 2rem;
    background-color: var(--white);
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.5s ease-in-out;
}

/* Styles responsifs pour les appareils mobiles */
@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
        gap: 0;
    }
    
    .auth-container {
        max-width: 400px;
    }
}

/* Ajustement pour les champs qui doivent prendre toute la largeur */
.full-width {
    width: 100%;
}
        
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        
        .logo img {
            height: 100px;
            margin-right: 10px;
        }
        
        .logo-text {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--dark-gray);
        }
        
        .auth-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }
        
        .auth-subtitle {
            color: var(--gray);
            font-size: 1rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            color: var(--dark-gray);
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #E2E8F0;
            border-radius: 5px;
            font-size: 1rem;
            color: var(--dark-gray);
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.1);
        }
        
        .form-error {
            color: #E53E3E;
            font-size: 0.75rem;
            margin-top: 0.5rem;
            display: block;
        }
        
        .form-checkbox-group {
            display: flex;
            align-items: center;
            margin-top: 1rem;
        }
        
        .form-checkbox {
            margin-right: 0.75rem;
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid #CBD5E0;
            appearance: none;
            cursor: pointer;
            position: relative;
            background-color: white;
        }
        
        .form-checkbox:checked {
            background-color: var(--orange);
            border-color: var(--orange);
        }
        
        .form-checkbox:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 12px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .form-checkbox-label {
            font-size: 0.875rem;
            color: var(--gray);
        }
        
.profile-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background-color: var(--orange);
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: 5px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.profile-link:hover {
    background-color: #e86000;
    transform: translateY(-2px);
}

.profile-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(255, 255, 255, 0.4);
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    color: var(--white);
}
        
        .btn-auth {
            width: 100%;
            padding: 0.75rem 1rem;
            background: linear-gradient(135deg, var(--orange) 0%, var(--green) 100%);
            color: var(--white);
            border: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #E2E8F0;
        }
        
        .auth-link {
            color: var(--orange);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .auth-link:hover {
            color: var(--green);
        }
        
        .password-strength {
            margin-top: 0.5rem;
            height: 5px;
            border-radius: 5px;
            background-color: #E2E8F0;
            overflow: hidden;
        }
        
        .password-strength-meter {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease, background-color 0.3s ease;
        }
        
        .password-strength-meter.weak {
            width: 33%;
            background-color: #F56565;
        }
        
        .password-strength-meter.medium {
            width: 66%;
            background-color: #ECC94B;
        }
        
        .password-strength-meter.strong {
            width: 100%;
            background-color: #48BB78;
        }
        
        .password-strength-text {
            font-size: 0.75rem;
            color: var(--gray);
            margin-top: 0.25rem;
            text-align: right;
        }

        /* Dashboard Styles */
        .sidebar {
            min-height: 100vh;
        }
        
        .sidebar .nav-link {
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        /* Navigation de la page d'accueil */
        nav {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
        }
        
        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background-color: var(--orange);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .nav-link.active {
            color: var(--orange);
        }
        
        .btn-connexion {
            background-color: var(--orange);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        /* Ajoutez ces styles dans la section CSS de votre page */

.profile-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background-color: var(--orange);
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: 5px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.profile-link:hover {
    background-color: #e86000;
    transform: translateY(-2px);
}

.profile-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(255, 255, 255, 0.4);
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    color: var(--white);
}

/* Style pour le lien du tableau de bord */
.dashboard-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background-color: var(--green);
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: 5px;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-right: 1rem;
}

.dashboard-link:hover {
    background-color: #008038;
    transform: translateY(-2px);
    box-shadow: 0 3px 8px rgba(0, 154, 68, 0.3);
}

.dashboard-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
}
        
        .btn-connexion:hover {
            background-color: #e86000;
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 80%;
                height: 100vh;
                z-index: 1000;
                transition: all 0.3s;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .content-wrapper {
                width: 100%;
            }
            
            .nav-links {
                display: none;
            }
            
            .mobile-menu-button {
                display: block;
            }
        }

        @media (max-width: 480px) {
            .auth-container {
                max-width: 90%;
                padding: 1.5rem;
            }
            
            .auth-title {
                font-size: 1.5rem;
            }
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="{{ Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register' ? 'auth-page' : '' }}">
    <!-- Navigation de la page d'accueil -->
    @if(Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register')
    <nav>
    <div class="container nav-container">
        <div class="logo">
            <img src="{{ asset('./photos/logoe.jpg') }}" alt="Logo État Civil CI">
           
        </div>
        
        <div class="nav-links">
            <a href="/" class="nav-link active">Accueil</a>
            
            <a href="/about" class="nav-link">À propos</a>
       
            
            @auth
                <!-- Ajout du lien vers le tableau de bord pour les utilisateurs connectés -->
                <a href="{{ route('citoyen.dashboard') }}" class="dashboard-link">
                    <div class="dashboard-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </div>
                    <span>Tableau de bord</span>
                </a>
                
                <a href="{{ route('profile.show') }}" class="profile-link">
                    <div class="profile-avatar">
                        @if(auth()->user()->profile_photo_path)
                            <img src="{{ asset(auth()->user()->profile_photo_path) }}" alt="Photo de profil">
                        @else
                            <div class="profile-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <span>Mon profil</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-connexion">Connexion</a>
            @endauth
        </div>
    </div>
</nav>
    @endif
    <!-- Content Area -->
    @yield('content')
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>