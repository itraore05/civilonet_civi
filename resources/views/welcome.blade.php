<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme d'État Civil - Côte d'Ivoire</title>
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
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Navigation */
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
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 100px;
            
        }
        
        .logo-text {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--dark-gray);
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
        
        .btn-connexion:hover {
            background-color: #e86000;
            transform: translateY(-2px);
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--orange) 0%, var(--green) 100%);
            padding: 5rem 0;
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/api/placeholder/1200/700') center/cover no-repeat;
            opacity: 0.1;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }
        
        .btn-primary {
            background-color: var(--white);
            color: var(--orange);
            padding: 1rem 2rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-secondary {
            background-color: transparent;
            color: var(--white);
            border: 2px solid var(--white);
            padding: 1rem 2rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        /* Services Section */
        .services {
            padding: 5rem 0;
            background-color: var(--white);
        }
        
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: var(--dark-gray);
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 5px;
            background: linear-gradient(to right, var(--orange), var(--green));
            border-radius: 5px;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .service-card {
            background-color: var(--light-gray);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--orange) 0%, var(--green) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        
        .service-icon svg {
            width: 40px;
            height: 40px;
            color: var(--white);
        }
        
        .service-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-gray);
        }
        
        .service-description {
            color: var(--gray);
            margin-bottom: 1.5rem;
        }
        
        .service-link {
            color: var(--orange);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .service-link:hover {
            color: var(--green);
        }
        
        .service-link svg {
            width: 20px;
            height: 20px;
            margin-left: 5px;
        }
        
        /* Process Section */
        .process {
            padding: 5rem 0;
            background-color: var(--light-gray);
        }
        
        .process-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }
        
        .process-step {
            text-align: center;
            position: relative;
        }
        
        .step-number {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--orange) 0%, var(--green) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--white);
            font-weight: 700;
            font-size: 1.25rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .step-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-gray);
        }
        
        .step-description {
            color: var(--gray);
        }
        
        /* Stats Section */
        .stats {
            padding: 5rem 0;
            background-color: var(--blue);
            color: var(--white);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            text-align: center;
        }
        
        .stat-item h3 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stat-item p {
            font-size: 1.2rem;
            opacity: 0.8;
        }
        
        /* Features Section */
        .features {
            padding: 5rem 0;
            background-color: var(--white);
        }
        
        .features-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 4rem;
            align-items: center;
        }
        
        .features-image {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .features-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .features-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: var(--dark-gray);
        }
        
        .feature-list {
            list-style: none;
        }
        
        .feature-item {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
        }
        
        .feature-icon {
            background: linear-gradient(135deg, var(--orange) 0%, var(--green) 100%);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }
        
        .feature-icon svg {
            width: 15px;
            height: 15px;
            color: var(--white);
        }
        
        .feature-text {
            color: var(--gray);
        }
        
        .feature-text strong {
            display: block;
            color: var(--dark-gray);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        /* News Section */
        .news {
            padding: 5rem 0;
            background-color: var(--light-gray);
        }
        
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .news-card {
            background-color: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .news-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .news-content {
            padding: 1.5rem;
        }
        
        .news-date {
            color: var(--gray);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }
        
        .news-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-gray);
        }
        
        .news-excerpt {
            color: var(--gray);
            margin-bottom: 1.5rem;
        }
        
        .news-link {
            color: var(--orange);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .news-link:hover {
            color: var(--green);
        }
        
        .news-link svg {
            width: 20px;
            height: 20px;
            margin-left: 5px;
        }
        
        /* Testimonials Section */
        .testimonials {
            padding: 5rem 0;
            background-color: var(--white);
        }
        
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .testimonial-card {
            background-color: var(--light-gray);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            position: relative;
        }
        
        .testimonial-card::before {
           
            position: absolute;
            top: 10px;
            left: 20px;
            font-size: 5rem;
            color: var(--orange);
            opacity: 0.2;
            line-height: 1;
        }
        
        .testimonial-content {
            margin-bottom: 1.5rem;
            color: var(--gray);
            font-style: italic;
            z-index: 1;
            position: relative;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
        }
        
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 1rem;
            background-color: var(--gray);
            overflow: hidden;
        }
        
        .author-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .author-name {
            font-weight: 600;
            color: var(--dark-gray);
        }
        
        .author-title {
            font-size: 0.875rem;
            color: var(--gray);
        }
        
        /* FAQ Section */
        .faq {
            padding: 5rem 0;
            background-color: var(--light-gray);
        }
        
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .faq-item {
            background-color: var(--white);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .faq-question {
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 1rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .faq-question svg {
            width: 20px;
            height: 20px;
            color: var(--orange);
            transition: transform 0.3s ease;
        }
        
        .faq-answer {
            color: var(--gray);
        }
        
        /* CTA Section */
        .cta {
            padding: 5rem 0;
            background: linear-gradient(135deg, var(--green) 0%, var(--blue) 100%);
            color: var(--white);
            text-align: center;
        }
        
        .cta h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .cta p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Footer */
        footer {
            background-color: var(--dark-gray);
            color: var(--white);
            padding: 4rem 0 2rem;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }
        
        .footer-column h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--white);
        }
        
        .footer-column p {
            color: #B0B0B0;
            margin-bottom: 1rem;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-link {
            margin-bottom: 0.75rem;
        }
        
        .footer-link a {
            color: #B0B0B0;
            transition: all 0.3s ease;
        }
        
        .footer-link a:hover {
            color: var(--white);
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
        }
        
        .social-link {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background-color: var(--orange);
            transform: translateY(-3px);
        }
        
        .social-link svg {
            width: 20px;
            height: 20px;
            color: var(--white);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #B0B0B0;
            font-size: 0.875rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .mobile-menu-button {
                display: block;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-primary, .btn-secondary {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body class="{{ Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register' ? 'auth-page' : '' }}">
    <!-- Navigation de la page d'accueil -->
    @if(Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register')
    <nav>
    <div class="container nav-container">
        <div class="logo">
            <img src="{{ asset('./photos/Logo OFFICIEL .png') }}" alt="Logo État Civil CI">
            
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

   <!-- Hero Section -->
<section class="hero">
    <div class="container hero-content">
        <h1>Plateforme Numérique d'État Civil de Côte d'Ivoire</h1>
        <p>Simplifiez vos démarches administratives et obtenez vos documents d'état civil en ligne, sans déplacement et en toute sécurité</p>
        <div class="hero-buttons">
            <a href="{{ route('login') }}" class="btn-primary">Créer un compte</a>
            <a href="#services" class="btn-secondary">Découvrir nos services</a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services">
    <div class="container">
        <h2 class="section-title">Nos Services</h2>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="service-title">Acte de Naissance</h3>
                <p class="service-description">Demandez et recevez votre acte de naissance en ligne en quelques clics. Procédure simplifiée et sécurisée.</p>
                <a href="{{ route('login') }}" class="service-link">
                    En savoir plus
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="service-title">Acte de Mariage</h3>
                <p class="service-description">Obtenez votre acte de mariage rapidement sans vous déplacer. Copies conformes et légalisées disponibles.</p>
                <a href="{{ route('login') }}" class="service-link">
                    En savoir plus
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="service-title">Acte de Décès</h3>
                <p class="service-description">Demande simplifiée d'acte de décès pour vos démarches administratives. Gagnez du temps dans ces moments difficiles.</p>
                <a href="{{ route('login') }}" class="service-link">
                    En savoir plus
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                </div>
                <h3 class="service-title">Certificat de Nationalité</h3>
                <p class="service-description">Effectuez votre demande de certificat de nationalité en ligne. Réception rapide après vérification.</p>
                <a href="{{ route('login') }}" class="service-link">
                    En savoir plus
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

    <!-- How it Works Section -->
    <section class="process">
        <div class="container">
            <h2 class="section-title">Comment ça marche ?</h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Créez un compte</h3>
                    <p class="step-description">Inscrivez-vous en quelques minutes avec vos informations personnelles</p>
                </div>
                
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Sélectionnez votre service</h3>
                    <p class="step-description">Choisissez le type d'acte dont vous avez besoin et remplissez le formulaire</p>
                </div>
                
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Payez en ligne</h3>
                    <p class="step-description">Effectuez un paiement sécurisé via mobile money, carte bancaire ou autres moyens</p>
                </div>
                
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h3 class="step-title">Recevez votre document</h3>
                    <p class="step-description">Téléchargez votre document officiel ou recevez-le par email avec signature électronique</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>250K+</h3>
                    <p>Utilisateurs inscrits</p>
                </div>
                
                <div class="stat-item">
                    <h3>1M+</h3>
                    <p>Documents délivrés</p>
                </div>
                
                <div class="stat-item">
                    <h3>98%</h3>
                    <p>Taux de satisfaction</p>
                </div>
                
                <div class="stat-item">
                    <h3>24/7</h3>
                    <p>Support disponible</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container features-container">
            <div class="features-image">
                <img src="{{ asset('./photos/Fonctionna.png') }}" alt="Fonctionnalités de la plateforme">
            </div>
            
            <div class="features-content">
                <h2>Une plateforme conçue pour vous simplifier la vie</h2>
                <ul class="feature-list">
                    <li class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <strong>Accessibilité 24/7</strong>
                            Accédez à vos services d'état civil à tout moment, où que vous soyez
                        </div>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <strong>Sécurité des données</strong>
                            Vos informations personnelles sont protégées avec les normes de sécurité les plus élevées
                        </div>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <strong>Rapidité de traitement</strong>
                            Recevez vos documents en 24 à 72 heures selon le type de service demandé
                        </div>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <strong>Authentification vérifiée</strong>
                            Documents légalement reconnus avec signatures électroniques certifiées
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

  

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Ce que disent nos utilisateurs</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <p class="testimonial-content">Grâce à cette plateforme, j'ai pu obtenir mon acte de naissance en seulement 48 heures alors que je suis à l'étranger. C'est un véritable changement qui facilite la vie des Ivoiriens de la diaspora.</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="{{ asset('./photos/paul.png') }}" alt="Avatar">
                        </div>
                        <div>
                            <div class="author-name">Konan Didier</div>
                            <div class="author-title">Étudiant à Abidjan</div>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <p class="testimonial-content">Le processus est simple et intuitif. J'ai pu faire une demande pour toute ma famille en une seule fois. Le support client est également très réactif et professionnel.</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="{{ asset('./photos/aminata.png') }}" alt="Avatar">
                        </div>
                        <div>
                            <div class="author-name">Aminata Koné</div>
                            <div class="author-title">Entrepreneur à Abidjan</div>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <p class="testimonial-content">Je craignais que ce soit compliqué, mais tout était bien expliqué. J'ai reçu mon acte de mariage numérisé et authentifié en moins de 3 jours. Une vraie révolution pour les démarches administratives !</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="{{ asset('./photos/konan.png') }}" alt="Avatar">
                        </div>
                        <div>
                            <div class="author-name">Paul Kouassi</div>
                            <div class="author-title">Fonctionnaire à Yamoussoukro</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq">
        <div class="container">
            <h2 class="section-title">Questions fréquentes</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        Comment puis-je créer un compte sur la plateforme ?
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer">
                        Pour créer un compte, cliquez sur le bouton "Créer un compte" en haut de la page. Vous devrez fournir votre nom complet, votre numéro de téléphone, une adresse email valide et créer un mot de passe sécurisé. Une vérification par SMS ou email vous sera envoyée pour valider votre compte.
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        Quels sont les délais pour recevoir mes documents ?
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer">
                        Les délais varient selon le type de document demandé. En général, les actes de naissance sont disponibles en 24 à 48 heures, les actes de mariage en 48 à 72 heures, et les certificats de nationalité peuvent prendre jusqu'à 5 jours ouvrables pour vérification.
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        Les documents délivrés en ligne sont-ils légalement valables ?
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer">
                        Oui, tous les documents délivrés via notre plateforme sont officiels et légalement reconnus. Ils comportent une signature électronique certifiée et un QR code permettant de vérifier leur authenticité auprès des autorités compétentes.
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        Quels moyens de paiement sont acceptés ?
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer">
                        Nous acceptons plusieurs moyens de paiement: Orange Money, MTN Mobile Money, Moov Money, cartes bancaires (Visa, Mastercard), et virements bancaires. Tous les paiements sont sécurisés et vous recevrez une confirmation de transaction.
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        Puis-je demander un document pour une autre personne ?
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer">
                        Oui, vous pouvez demander des documents pour les membres de votre famille en fournissant les informations requises. Pour certains types de documents, vous devrez justifier votre lien avec la personne concernée ou fournir une procuration.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Prêt à simplifier vos démarches administratives ?</h2>
            <p>Rejoignez les milliers d'Ivoiriens qui utilisent notre plateforme pour obtenir leurs documents d'état civil rapidement et facilement.</p>
            <a href="{{ route('register') }}" class="btn-primary">Créer un compte maintenant</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>État Civil CI</h3>
                    <p>Plateforme officielle de gestion des actes d'état civil en Côte d'Ivoire. Service public numérique du Ministère de l'Administration du Territoire.</p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                            </svg>
                        </a>
                        <a href="#" class="social-link">
                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"></path>
                            </svg>
                        </a>
                        <a href="#" class="social-link">
                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                        </a>
                        <a href="#" class="social-link">
                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14m-.5 15.5v-5.3a3.26 3.26 0 00-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 011.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 001.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 00-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Liens rapides</h3>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="/">Accueil</a></li>
                        <li class="footer-link"><a href="#">Services</a></li>
                        
                        
                        <li class="footer-link"><a href="/about">À propos</a></li>
                        <li class="footer-link"><a href="/about">Nous contacter</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Services</h3>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="#">Acte de naissance</a></li>
                        <li class="footer-link"><a href="#">Acte de mariage</a></li>
                        <li class="footer-link"><a href="#">Acte de décès</a></li>
                        <li class="footer-link"><a href="#">Certificat de nationalité</a></li>
                        <li class="footer-link"><a href="#">Casier judiciaire</a></li>
                        <li class="footer-link"><a href="#">Attestation de résidence</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Contact</h3>
                    <ul class="footer-links">
                        <li class="footer-link">Plateau, Avenue de la République</li>
                        <li class="footer-link">Abidjan, Côte d'Ivoire</li>
                        <li class="footer-link">info@civilonet.net</li>
                        <li class="footer-link">+225 07 89 54 40 23</li>
                        <li class="footer-link">Lundi - Vendredi: 8h00 - 17h00</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2023 Plateforme d'État Civil - République de Côte d'Ivoire. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Simple JavaScript pour les accordéons FAQ
        document.addEventListener('DOMContentLoaded', () => {
            const faqQuestions = document.querySelectorAll('.faq-question');
            
            faqQuestions.forEach(question => {
                question.addEventListener('click', () => {
                    const answer = question.nextElementSibling;
                    const icon = question.querySelector('svg');
                    
                    answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
                    icon.style.transform = answer.style.display === 'block' ? 'rotate(180deg)' : 'rotate(0)';
                });
                
                // Cache toutes les réponses par défaut
                question.nextElementSibling.style.display = 'none';
            });
        });
    </script>
</body>
</html