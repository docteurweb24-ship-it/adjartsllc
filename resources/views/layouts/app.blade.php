<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ \App\Models\SiteSetting::getValue('site_name', 'ADJ ARTS') }} - @yield('title')</title>
    <meta name="description" content="{{ \App\Models\SiteSetting::getValue('meta_description', 'ADJ ARTS - Artisanat africain authentique') }}">
    <meta name="keywords" content="{{ \App\Models\SiteSetting::getValue('keywords', 'bijoux, art africain, artisanat, création') }}">
    <style>
        :root {
            --gold: #D4AF37;
            --pink: #FFC0CB;
            --black: #000000;
            --cream: #f8f4e9;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --light-text: #2d3748;
            --light-card: #ffffff;
            --light-border: #e2e8f0;
        }
        
        /* Mode Sombre (par défaut) */
        [data-theme="dark"] {
            --bg-primary: #0a0a0a;
            --bg-secondary: #1a1a1a;
            --bg-card: rgba(255, 255, 255, 0.05);
            --text-primary: var(--cream);
            --text-secondary: rgba(248, 244, 233, 0.8);
            --border-color: rgba(212, 175, 55, 0.3);
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            --pattern-color: rgba(212, 175, 55, 0.03);
        }
        
        /* Mode Clair */
        [data-theme="light"] {
            --bg-primary: var(--light-bg);
            --bg-secondary: var(--white);
            --bg-card: var(--light-card);
            --text-primary: var(--light-text);
            --text-secondary: #4a5568;
            --border-color: var(--light-border);
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            --pattern-color: rgba(212, 175, 55, 0.05);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
        
        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            font-family: 'Raleway', Arial, sans-serif;
            line-height: 1.6;
            position: relative;
            min-height: 100vh;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                linear-gradient(var(--bg-primary), var(--bg-primary)),
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 10px,
                    var(--pattern-color) 10px,
                    var(--pattern-color) 20px
                );
            pointer-events: none;
            z-index: -1;
        }
        
        /* Navigation */
        .navbar {
            background: var(--bg-secondary);
            padding: 0.8rem 0;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }
        
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo-img {
            height: 80px; /* Logo très grand */
            width: auto;
            transition: transform 0.3s ease;
            object-fit: contain;
        }
        
        .logo-img:hover {
            transform: scale(1.05);
        }
        
        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }
        
        .nav-links a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
            font-size: 1.1rem;
        }
        
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gold);
            transition: width 0.3s ease;
        }
        
        .nav-links a:hover {
            color: var(--gold);
        }
        
        .nav-links a:hover::after {
            width: 100%;
        }
        
        /* Sélecteur de Langue */
        .language-switcher {
            position: relative;
            display: inline-block;
        }
        
        .language-btn {
            background: rgba(212, 175, 55, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.3);
            color: var(--text-primary);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .language-btn:hover {
            background: rgba(212, 175, 55, 0.2);
        }
        
        .language-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.5rem 0;
            min-width: 120px;
            box-shadow: var(--shadow);
            display: none;
            z-index: 1001;
        }
        
        .language-dropdown.show {
            display: block;
        }
        
        .language-option {
            padding: 0.5rem 1rem;
            color: var(--text-primary);
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
        }
        
        .language-option:hover {
            background: rgba(212, 175, 55, 0.1);
            color: var(--gold);
        }
        
        /* Theme Switcher */
        .theme-switcher {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(212, 175, 55, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 50px;
            padding: 0.3rem;
            cursor: pointer;
        }
        
        .theme-btn {
            background: none;
            border: none;
            padding: 0.5rem;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
        }
        
        .theme-btn.active {
            background: var(--gold);
            color: black;
        }
        
        .theme-btn svg {
            width: 18px;
            height: 18px;
        }
        
        /* Contenu principal */
        .main-content {
            min-height: 70vh;
            padding: 2rem 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        /* Cartes */
        .glass-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow);
        }
        
        /* Footer */
        .footer {
            background: var(--bg-secondary);
            padding: 3rem 0;
            margin-top: 4rem;
            border-top: 1px solid var(--border-color);
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        /* Boutons */
        .btn-gold {
            background: linear-gradient(135deg, var(--gold), #e6c158);
            color: black;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }
        
        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        }
        
        .btn-outline-gold {
            border: 2px solid var(--gold);
            color: var(--gold);
            padding: 10px 22px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
            background: transparent;
        }
        
        .btn-outline-gold:hover {
            background: var(--gold);
            color: black;
            transform: translateY(-2px);
        }
        
        /* Grille produits */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .product-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(212, 175, 55, 0.2);
            border-color: var(--gold);
        }
        
        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            background: var(--bg-secondary);
        }
        
        .product-info {
            padding: 1.5rem;
        }
        
        /* WhatsApp Float */
        .whatsapp-float {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 1000;
        }
        
        .whatsapp-link {
            background: #25D366;
            color: white;
            padding: 12px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
        }
        
        .whatsapp-link:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
        }
        
        /* Utilitaires */
        .text-gold { color: var(--gold); }
        .text-pink { color: var(--pink); }
        .text-center { text-align: center; }
        
        .badge {
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .badge-gold {
            background: var(--gold);
            color: black;
        }
        
        .badge-success {
            background: #25D366;
            color: white;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .logo-container {
                justify-content: center;
            }
            
            .nav-links {
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .container {
                padding: 0 1rem;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }
            
            .language-dropdown {
                right: auto;
                left: 0;
            }
            
            .logo-img {
                height: 70px; /* Grand sur mobile aussi */
            }
        }

        @media (max-width: 480px) {
            .logo-img {
                height: 60px; /* Encore grand sur petits écrans */
            }
        }
    </style>
</head>
<body data-theme="dark">
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo-container">
                <!-- LOGO SEUL SANS TEXTE -->
                <a href="/">
                    <img src="/storage/images/logo.png" alt="{{ \App\Models\SiteSetting::getValue('site_name', 'ADJ ARTS') }} Logo" class="logo-img" 
                         onerror="this.style.display='none'">
                </a>
            </div>
            <div class="nav-links">
                @php
                    // Récupérer les éléments de navigation depuis la base de données
                    $navItems = [
                        ['text' => 'nav_item1_text', 'url' => 'nav_item1_url'],
                        ['text' => 'nav_item2_text', 'url' => 'nav_item2_url'],
                        ['text' => 'nav_item3_text', 'url' => 'nav_item3_url'],
                        ['text' => 'nav_item4_text', 'url' => 'nav_item4_url'],
                        ['text' => 'nav_item5_text', 'url' => 'nav_item5_url'],
                        ['text' => 'nav_item6_text', 'url' => 'nav_item6_url'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php
                        $text = \App\Models\SiteSetting::getValue($item['text']);
                        $url = \App\Models\SiteSetting::getValue($item['url']);
                    @endphp
                    @if($text && $url)
                        <a href="{{ $url }}">{{ $text }}</a>
                    @endif
                @endforeach
                
                <!-- Sélecteur de Langue -->
                <div class="language-switcher">
                    <button class="language-btn" id="languageBtn">
                        FR
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </button>
                    <div class="language-dropdown" id="languageDropdown">
                        <a href="?lang=fr" class="language-option">FR - Français</a>
                        <a href="?lang=en" class="language-option">EN - English</a>
                        <a href="?lang=es" class="language-option">ES - Español</a>
                    </div>
                </div>
                
                <!-- Theme Switcher -->
                <div class="theme-switcher">
                    <button class="theme-btn active" data-theme="dark" title="Mode Sombre">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21.4,13.7C20.6,13.9,19.8,14,19,14c-5,0-9-4-9-9c0-0.8,0.1-1.6,0.3-2.4c0.1-0.3,0-0.7-0.3-1 c-0.3-0.3-0.6-0.4-1-0.3C4.3,2.7,1,7.1,1,12c0,6.1,4.9,11,11,11c4.9,0,9.3-3.3,10.6-8.1c0.1-0.3,0-0.7-0.3-1 C22.1,13.7,21.7,13.6,21.4,13.7z"/>
                        </svg>
                    </button>
                    <button class="theme-btn" data-theme="light" title="Mode Clair">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,7c-2.8,0-5,2.2-5,5s2.2,5,5,5s5-2.2,5-5S14.8,7,12,7z M12,15c-1.7,0-3-1.3-3-3s1.3-3,3-3s3,1.3,3,3 S13.7,15,12,15z M12,2L13,5h-2L12,2z M12,22l-1-3h2L12,22z M22,12l-3,1v-2L22,12z M2,12l3-1v2L2,12z M18.4,18.4l-2.1-2.1l1.4-1.4 l2.1,2.1L18.4,18.4z M5.6,5.6l2.1,2.1l-1.4,1.4L4.2,7L5.6,5.6z M18.4,5.6l1.4,1.4l-2.1,2.1l-1.4-1.4L18.4,5.6z M5.6,18.4l2.1-2.1 l1.4,1.4l-2.1,2.1L5.6,18.4z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div>
                <h3 class="text-gold">{{ \App\Models\SiteSetting::getValue('site_name', 'ADJ ARTS') }}</h3>
                <p>{{ \App\Models\SiteSetting::getValue('footer_description', 'L\'art, les yeux d\'Afrique') }}</p>
                <p style="opacity: 0.8;">{{ \App\Models\SiteSetting::getValue('footer_tagline', 'Artisanat africain authentique') }}</p>
            </div>
            <div>
                <h4 class="text-gold">Contact</h4>
                <p>{{ \App\Models\SiteSetting::getValue('footer_email', 'contact@adjarts.com') }}</p>
                <p>WhatsApp: {{ \App\Models\SiteSetting::getValue('footer_phone', '+229 XX XX XX XX') }}</p>
                @if(\App\Models\SiteSetting::getValue('address'))
                    <p>{{ \App\Models\SiteSetting::getValue('address') }}</p>
                @endif
            </div>
            <div>
                <h4 class="text-gold">Liens Rapides</h4>
                @php
                    // Récupérer les liens du footer depuis la base de données
                    $footerLinks = [
                        ['text' => 'link1_text', 'url' => 'link1_url'],
                        ['text' => 'link2_text', 'url' => 'link2_url'],
                        ['text' => 'link3_text', 'url' => 'link3_url'],
                    ];
                @endphp

                @foreach($footerLinks as $link)
                    @php
                        $text = \App\Models\SiteSetting::getValue($link['text']);
                        $url = \App\Models\SiteSetting::getValue($link['url']);
                    @endphp
                    @if($text && $url)
                        <p><a href="{{ $url }}" style="text-decoration: none; color: inherit;">{{ $text }}</a></p>
                    @endif
                @endforeach
            </div>
        </div>
        <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border-color);">
            <p style="opacity: 0.7;">{{ \App\Models\SiteSetting::getValue('copyright_text', '© 2024 ADJ ARTS. Tous droits réservés.') }}</p>
        </div>
    </footer>

    <!-- WhatsApp Float -->
    <div class="whatsapp-float">
        <a href="https://wa.me/{{ \App\Models\SiteSetting::getValue('footer_whatsapp', '+229XXXXXXXXX') }}" target="_blank" class="whatsapp-link">
            <span>WhatsApp</span>
        </a>
    </div>

    <script>
        // Gestion du thème
        class ThemeManager {
            constructor() {
                this.theme = localStorage.getItem('theme') || 'dark';
                this.init();
            }
            
            init() {
                this.setTheme(this.theme);
                this.bindEvents();
            }
            
            setTheme(theme) {
                this.theme = theme;
                document.body.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);
                
                // Mettre à jour les boutons
                document.querySelectorAll('.theme-btn').forEach(btn => {
                    btn.classList.toggle('active', btn.dataset.theme === theme);
                });
            }
            
            bindEvents() {
                document.querySelectorAll('.theme-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        this.setTheme(btn.dataset.theme);
                    });
                });
            }
        }

        // Gestion simple du sélecteur de langue
        document.addEventListener('DOMContentLoaded', function() {
            new ThemeManager();
            
            // Sélecteur de langue
            const languageBtn = document.getElementById('languageBtn');
            const languageDropdown = document.getElementById('languageDropdown');
            
            if (languageBtn && languageDropdown) {
                languageBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    languageDropdown.classList.toggle('show');
                });
                
                // Fermer le dropdown quand on clique ailleurs
                document.addEventListener('click', () => {
                    languageDropdown.classList.remove('show');
                });
                
                // Empêcher la fermeture quand on clique dans le dropdown
                languageDropdown.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
            }
        });
    </script>
</body>
</html>