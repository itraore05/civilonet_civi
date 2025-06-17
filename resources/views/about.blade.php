<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - Plateforme d'État Civil - Côte d'Ivoire</title>
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
            margin-right: 10px;
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
        
        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--blue) 0%, var(--green) 100%);
            padding: 5rem 0;
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/api/placeholder/1200/300') center/cover no-repeat;
            opacity: 0.1;
        }
        
        .header-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .page-header h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .page-header p {
            font-size: 1.2rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Section Title */
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
        
        /* About Section */
        .about-section {
            padding: 5rem 0;
            background-color: var(--white);
        }
        
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        
        .about-image {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .about-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .about-content h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--dark-gray);
        }
        
        .about-content p {
            margin-bottom: 1.5rem;
            color: var(--gray);
        }
        
        /* Mission Section */
        .mission-section {
            padding: 5rem 0;
            background-color: var(--light-gray);
        }
        
        .mission-values {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .mission-card {
            background-color: var(--white);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .mission-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .mission-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--orange) 0%, var(--green) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        
        .mission-icon svg {
            width: 40px;
            height: 40px;
            color: var(--white);
        }
        
        .mission-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-gray);
        }
        
        .mission-description {
            color: var(--gray);
        }
        
        /* Team Section */
        .team-section {
            padding: 5rem 0;
            background-color: var(--white);
        }
        
        .team-categories {
            margin-bottom: 3rem;
        }
        
        .team-category {
            margin-bottom: 4rem;
        }
        
        .category-title {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 2rem;
            color: var(--dark-gray);
            text-align: center;
            position: relative;
        }
        
        .category-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, var(--orange), var(--green));
            border-radius: 5px;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .team-member {
            background-color: var(--light-gray);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        /* Container de l'image */
        .member-image {
            position: relative;
            height: 300px; /* Hauteur fixe pour uniformiser les images */
            width: 100%;
            overflow: hidden; /* Masque tout débordement */
        }
        
        /* Style de l'image */
        .member-image img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Redimensionne l'image pour couvrir la zone sans la déformer */
            object-position: center top; /* Centre l'image horizontalement et privilégie le haut verticalement */
            transition: transform 0.5s ease;
        }
        
        .team-member:hover .member-image img {
            transform: scale(1.05);
        }
        
        .member-info {
            padding: 1.5rem;
            text-align: center;
        }
        
        .member-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-gray);
        }
        
        .member-role {
            color: var(--orange);
            font-weight: 500;
            margin-bottom: 1rem;
        }
        
        .member-description {
            color: var(--gray);
            margin-bottom: 1.5rem;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        
        .social-link {
            width: 35px;
            height: 35px;
            background-color: rgba(0, 0, 0, 0.05);
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
            width: 18px;
            height: 18px;
            color: var(--dark-gray);
        }
        
        .social-link:hover svg {
            color: var(--white);
        }

        /* Section de contact */
.contact-section {
    padding: 5rem 0;
    background-color: #f9f9f9;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    margin-top: 2.5rem;
}

/* Informations de contact */
.contact-info {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    padding: 2.5rem;
    height: 100%;
}

.contact-info h3 {
    color: #2a323d;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.contact-info > p {
    color: #667085;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.contact-details {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
}

.contact-icon {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 50%;
    background-color: rgba(24, 119, 242, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
}

.contact-icon svg {
    width: 20px;
    height: 20px;
    color: #1877f2;
}

.contact-text h4 {
    font-size: 1rem;
    color: #2a323d;
    margin-bottom: 0.25rem;
}

.contact-text p {
    color: #667085;
    font-size: 0.95rem;
    line-height: 1.5;
}

.contact-social {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.contact-social .social-link {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background-color: #f2f4f7;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1877f2;
    transition: all 0.2s ease;
}

.contact-social .social-link:hover {
    background-color: #1877f2;
    color: #fff;
}

.contact-social .social-link svg {
    width: 20px;
    height: 20px;
}

/* Formulaire de contact */
.contact-form-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    padding: 2.5rem;
}

.contact-form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: span 2;
}

.form-group label {
    font-size: 0.95rem;
    color: #2a323d;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 0.75rem 1rem;
    border: 1px solid #e1e4e8;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.2s ease;
    color: #2a323d;
    background-color: #fff;
    width: 100%;
    font-family: inherit;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #1877f2;
    outline: none;
    box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.15);
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: #a0aec0;
}

.btn-submit {
    background-color: #1877f2;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 0.9rem 1.5rem;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
    width: 100%;
    margin-top: 0.5rem;
}

.btn-submit:hover {
    background-color: #1568d3;
}

/* Media queries pour la responsivité */
@media (max-width: 992px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .contact-info {
        margin-bottom: 0;
    }
}

@media (max-width: 768px) {
    .contact-form {
        grid-template-columns: 1fr;
    }
    
    .form-group.full-width {
        grid-column: span 1;
    }
    
    .contact-section {
        padding: 3rem 0;
    }
}

@media (max-width: 576px) {
    .contact-info,
    .contact-form-container {
        padding: 1.5rem;
    }
}
        
        /* Partners Section */
        .partners-section {
            padding: 5rem 0;
            background-color: var(--light-gray);
        }
        
        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 2rem;
            align-items: center;
        }
        
        .partner-logo {
            background-color: var(--white);
            border-radius: 10px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .partner-logo:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .partner-logo img {
            max-width: 100%;
            max-height: 80px;
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
        
        .btn-primary {
            background-color: var(--white);
            color: var(--blue);
            padding: 1rem 2rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
        
        .social-links-footer {
            display: flex;
            gap: 1rem;
        }
        
        .social-link-footer {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .social-link-footer:hover {
            background-color: var(--orange);
            transform: translateY(-3px);
        }
        
        .social-link-footer svg {
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
        @media (max-width: 992px) {
            .about-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .about-image {
                order: -1;
            }
        }
        
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .mobile-menu-button {
                display: block;
            }
            
            .page-header h1 {
                font-size: 2.5rem;
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

    <!-- Page Header -->
    <section class="page-header">
        <div class="container header-content">
            <h1>À propos de nous</h1>
            <p>Découvrez notre histoire, notre mission et l'équipe qui rend possible la transformation numérique de l'état civil ivoirien</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <h2 class="section-title">Notre Histoire</h2>
            <div class="about-grid">
                <div class="about-content">
                    <h2>Une initiative pour moderniser l'état civil ivoirien</h2>
                    <p>La Plateforme Numérique d'État Civil de Côte d'Ivoire est née d'une vision ambitieuse : transformer et moderniser le système d'état civil ivoirien pour le rendre plus accessible, efficace et sécurisé.</p>
                    <p>Lancée en avril 2025 sous l’impulsion de l’UVCI, dans le cadre des Projets Collectifs Tuteurés (PCT), l’initiative nommée Civilonet s’inscrit pleinement dans la stratégie nationale de développement numérique intitulée “Côte d’Ivoire Numérique 2025”.</p>
                    <p>Notre plateforme vise à simplifier les démarches administratives des citoyens tout en renforçant la fiabilité des documents d'état civil, contribuant ainsi à la consolidation de l'identité juridique de chaque Ivoirien.</p>
                </div>
                <div class="about-image">
                    <img src="{{ asset('./photos/Notre Histoire.png') }}" alt="Historique de la plateforme">
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values Section -->
    <section class="mission-section">
        <div class="container">
            <h2 class="section-title">Notre Mission & Nos Valeurs</h2>
            <div class="mission-values">
                <div class="mission-card">
                    <div class="mission-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="mission-title">Notre Mission</h3>
                    <p class="mission-description">Digitaliser l'ensemble des services d'état civil pour offrir aux citoyens ivoiriens un accès simple, rapide et sécurisé à leurs documents officiels, tout en garantissant l'intégrité et la pérennité des données d'état civil.</p>
                </div>
                
                <div class="mission-card">
                    <div class="mission-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="mission-title">Fiabilité & Sécurité</h3>
                    <p class="mission-description">Nous garantissons l'authenticité et la sécurité des documents délivrés. Notre plateforme utilise des technologies de pointe pour protéger les données personnelles et prévenir les fraudes documentaires.</p>
                </div>
                
                <div class="mission-card">
                    <div class="mission-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                    </div>
                    <h3 class="mission-title">Accessibilité</h3>
                    <p class="mission-description">Nous nous engageons à rendre les services d'état civil accessibles à tous les citoyens, où qu'ils se trouvent, y compris dans les zones rurales et pour la diaspora ivoirienne à l'étranger.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Section de contact -->
<section class="contact-section">
    <div class="container">
        <h2 class="section-title">Contactez-Nous</h2>
        <div class="contact-grid">
            <div class="contact-info">
                <h3>Nous sommes à votre écoute</h3>
                <p>Si vous avez des questions ou des préoccupations concernant nos services d'état civil, n'hésitez pas à nous contacter. Notre équipe vous répondra dans les plus brefs délais.</p>
                
                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h4>Adresse</h4>
                            <p>Plateau, Avenue de la République<br>Abidjan, Côte d'Ivoire</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <p>info@civilonet.net</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h4>Téléphone</h4>
                            <p>+225 07 89 54 40 23</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h4>Heures d'ouverture</h4>
                            <p>Lundi - Vendredi: 8h00 - 17h00</p>
                        </div>
                    </div>
                </div>
                
                <div class="social-links contact-social">
                    <a href="#" class="social-link">
                        <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
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
            
            <div class="contact-form-container">
                <form class="contact-form">
                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" name="name" placeholder="Votre nom et prénom" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Votre adresse email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Sujet</label>
                        <select id="subject" name="subject" required>
                            <option value="" disabled selected>Sélectionnez un sujet</option>
                            <option value="demande">Demande d'information</option>
                            <option value="probleme">Signaler un problème</option>
                            <option value="suggestion">Suggestion</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Votre message" required></textarea>
                    </div>
                    
                    <div class="form-group full-width">
                        <button type="submit" class="btn-submit">Envoyer le message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

    <section class="team-section">
    <div class="container">
        <h2 class="section-title">Notre Équipe</h2>
        <div class="team-categories">
            <div class="team-category">
                <h3 class="category-title">Équipe Base de Données (BD)</h3>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-image">
                            <img src="{{ asset('./photos/maimouna.jpg') }}" alt="Kouassi Aya">
                        </div>
                        <div class="member-info">
                            <h4 class="member-name">TRAORÉ Maimouna Ange-Cécilia</h4>
                            <p class="member-role">Déléguée du Projet</p>
                            <p class="member-description">Responsable de la coordination générale et de l'implémentation des aspects techniques liés à la base de données.</p>
                            <div class="social-links">
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14m-.5 15.5v-5.3a3.26 3.26 0 00-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 011.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 001.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 00-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-image">
                            <img src="{{ asset('./photos/wanga.jpg') }}" alt="Koffi Emmanuel">
                        </div>
                        <div class="member-info">
                            <h4 class="member-name">VANGAH Jacques-Alex Joseph</h4>
                            <p class="member-role">secrétaire & Analyste DB</p>
                            <p class="member-description">Responsable de la modélisation et de la gestion des données.</p>
                            <div class="social-links">
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14m-.5 15.5v-5.3a3.26 3.26 0 00-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 011.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 001.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 00-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-image">
                            <img src="{{ asset('./photos/joseph.jpg') }}" alt="Bamba Fatoumata">
                        </div>
                        <div class="member-info">
                            <h4 class="member-name">TRAORÉ Joseph</h4>
                            <p class="member-role">Admin Base de Données</p>
                            <p class="member-description">En charge de l'optimisation de la base de données.</p>
                            <div class="social-links">
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14m-.5 15.5v-5.3a3.26 3.26 0 00-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 011.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 001.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 00-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="team-category">
                <h3 class="category-title">Équipe Développement Web (DAS)</h3>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-image">
                            <img src="{{ asset('./photos/ismael.jpg') }}" alt="Koné Ibrahim">
                        </div>
                        <div class="member-info">
                            <h4 class="member-name">TRAORE Ismaël</h4>
                            <p class="member-role">SOUS - Delegué</p>
                            <p class="member-description">Développeur full-stack. En charge de l'intégration des fonctionnalités back-end et front-end</p>
                            <div class="social-links">
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14m-.5 15.5v-5.3a3.26 3.26 0 00-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 011.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 001.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 00-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-image">
                            <img src="{{ asset('./photos/samba.jpg') }}" alt="Diallo Mariam">
                        </div>
                        <div class="member-info">
                            <h4 class="member-name">TRAORÉ Samba</h4>
                            <p class="member-role">Développeuse frontend</p>
                            <p class="member-description">Chargé de la conception et de l'ergonomie de l'interface utilisateur</p>
                            <div class="social-links">
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14m-.5 15.5v-5.3a3.26 3.26 0 00-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 011.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 001.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 00-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-image">
                            <img src="{{ asset('./photos/affoutr.png') }}" alt="Touré Seydou">
                        </div>
                        <div class="member-info">
                            <h4 class="member-name">TRAORÉ Affoussiata</h4>
                            <p class="member-role">Développeur frontend</p>
                            <p class="member-description">En charge de l'interface utilisateur.</p>
                            <div class="social-links">
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14m-.5 15.5v-5.3a3.26 3.26 0 00-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 011.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 001.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 00-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <li class="footer-link">info@etatcivil.ci</li>
                        <li class="footer-link">+225 27 20 30 40 50</li>
                        <li class="footer-link">Lundi - Vendredi: 8h00 - 17h00</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2023 Plateforme d'État Civil - République de Côte d'Ivoire. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    </body>
    </html