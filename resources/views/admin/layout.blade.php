<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin ADJ ARTS - @yield('title')</title>
    <style>
        :root {
            --gold: #D4AF37;
            --pink: #FFC0CB;
            --black: #000000;
            --dark-bg: #0a0a0a;
            --cream: #f8f4e9;
        }
        /* Mode Sombre (par défaut) */
[data-theme="dark"] {
    --bg-primary: #0a0a0a;
    --bg-secondary: #1a1a1a;
    --bg-card: rgba(255, 255, 255, 0.05);
    --text-primary: #f8f4e9;
    --text-secondary: rgba(248, 244, 233, 0.8);
    --border-color: rgba(212, 175, 55, 0.3);
}

/* Mode Clair */
[data-theme="light"] {
    --bg-primary: #f8f9fa;
    --bg-secondary: #ffffff;
    --bg-card: #ffffff;
    --text-primary: #2d3748;
    --text-secondary: #4a5568;
    --border-color: #e2e8f0;
}

body {
    background-color: var(--bg-primary);
    color: var(--text-primary);
    transition: background-color 0.3s ease, color 0.3s ease;
}

.sidebar {
    background: var(--bg-secondary);
    border-right: 1px solid var(--border-color);
}

.admin-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
}

.admin-table {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
}

.admin-table th {
    background: rgba(212, 175, 55, 0.1);
    color: var(--gold);
}

.admin-table td {
    color: var(--text-primary);
    border-bottom: 1px solid var(--border-color);
}

/* Ajouter le switcher dans la sidebar admin */
.theme-switcher {
    margin: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(212, 175, 55, 0.1);
    border: 1px solid rgba(212, 175, 55, 0.3);
    border-radius: 50px;
    padding: 0.3rem;
    cursor: pointer;
}
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: 
                linear-gradient(rgba(10, 10, 10, 0.95), rgba(10, 10, 10, 0.98)),
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 10px,
                    rgba(212, 175, 55, 0.03) 10px,
                    rgba(212, 175, 55, 0.03) 20px
                );
            color: white;
            font-family: 'Raleway', Arial, sans-serif;
            line-height: 1.6;
        }
        
        .admin-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            border-right: 1px solid var(--gold);
            padding: 2rem 0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 2rem;
            padding: 0 1.5rem;
        }
        
        .logo h2 {
            color: var(--gold);
            font-size: 1.5rem;
        }
        
        .logo p {
            color: var(--cream);
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0 1.5rem;
        }
        
        .nav-links a {
            color: var(--cream);
            text-decoration: none;
            padding: 1rem 1.5rem;
            border-radius: 6px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        
        .nav-links a:hover {
            background: rgba(212, 175, 55, 0.1);
            color: var(--gold);
        }
        
        .nav-links a.active {
            background: rgba(212, 175, 55, 0.2);
            color: var(--gold);
            border-left: 3px solid var(--gold);
        }
        
        /* Main Content */
        .main-content {
            padding: 2rem;
            overflow-y: auto;
        }
        
        .header {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 12px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: between;
            align-items: center;
        }
        
        .header h1 {
            color: var(--gold);
            margin: 0;
        }
        
        /* Cartes Admin */
        .admin-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        
        /* Boutons Admin */
        .btn-admin {
            background: linear-gradient(135deg, var(--gold), #e6c158);
            color: black;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
            color: black;
        }
        
        .btn-outline-admin {
            border: 2px solid var(--gold);
            color: var(--gold);
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            transition: all 0.3s;
            background: transparent;
        }
        
        .btn-outline-admin:hover {
            background: var(--gold);
            color: black;
        }
        
        /* Tableaux */
        .admin-table {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        
        .admin-table th {
            background: rgba(212, 175, 55, 0.1);
            color: var(--gold);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }
        
        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
            color: var(--cream);
        }
        
        .admin-table tr:hover {
            background: rgba(212, 175, 55, 0.05);
        }
        
        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--gold);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: var(--cream);
            opacity: 0.8;
        }
        
        /* Utilitaires */
        .text-gold { color: var(--gold); }
        .text-pink { color: var(--pink); }
        .text-cream { color: var(--cream); }
        
        .badge {
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .badge-success { background: #25D366; color: white; }
        .badge-warning { background: #FFC107; color: black; }
        .badge-info { background: #17a2b8; color: white; }
        .badge-secondary { background: #6c757d; color: white; }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h2>🛠️ ADJ ARTS</h2>
                <p>Administration</p>
                
            </div>
            <!-- Theme Switcher -->
<div class="theme-switcher">
    <button class="theme-btn active" data-theme="dark" title="Mode Sombre">
        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
            <path d="M21.4,13.7C20.6,13.9,19.8,14,19,14c-5,0-9-4-9-9c0-0.8,0.1-1.6,0.3-2.4c0.1-0.3,0-0.7-0.3-1 c-0.3-0.3-0.6-0.4-1-0.3C4.3,2.7,1,7.1,1,12c0,6.1,4.9,11,11,11c4.9,0,9.3-3.3,10.6-8.1c0.1-0.3,0-0.7-0.3-1 C22.1,13.7,21.7,13.6,21.4,13.7z"/>
        </svg>
    </button>
    <button class="theme-btn" data-theme="light" title="Mode Clair">
        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
            <path d="M12,7c-2.8,0-5,2.2-5,5s2.2,5,5,5s5-2.2,5-5S14.8,7,12,7z M12,15c-1.7,0-3-1.3-3-3s1.3-3,3-3s3,1.3,3,3 S13.7,15,12,15z M12,2L13,5h-2L12,2z M12,22l-1-3h2L12,22z M22,12l-3,1v-2L22,12z M2,12l3-1v2L2,12z M18.4,18.4l-2.1-2.1l1.4-1.4 l2.1,2.1L18.4,18.4z M5.6,5.6l2.1,2.1l-1.4,1.4L4.2,7L5.6,5.6z M18.4,5.6l1.4,1.4l-2.1,2.1l-1.4-1.4L18.4,5.6z M5.6,18.4l2.1-2.1 l1.4,1.4l-2.1,2.1L5.6,18.4z"/>
        </svg>
    </button>
</div>
            
            <nav class="nav-links">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                     Tableau de bord
                </a>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                     Produits
                </a>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    Catégories
                </a>
                <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                     Pages
                </a>
                <a href="{{ route('admin.promotions.index') }}" class="{{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
                     Promotions
                </a>
                <a href="/" target="_blank">
                     Voir le site
                </a>
                <a href="/logout" style="margin-top: 2rem; color: #ff6b6b;">
                     Déconnexion
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>
</html><script>
    // Gestion du thème pour l'admin
    class AdminThemeManager {
        constructor() {
            this.theme = localStorage.getItem('admin-theme') || 'dark';
            this.init();
        }
        
        init() {
            this.setTheme(this.theme);
            this.bindEvents();
        }
        
        setTheme(theme) {
            this.theme = theme;
            document.body.setAttribute('data-theme', theme);
            localStorage.setItem('admin-theme', theme);
            
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
    
    // Initialiser le gestionnaire de thème admin
    new AdminThemeManager();
</script>