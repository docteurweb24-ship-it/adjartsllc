@extends('layouts.app')

@section('title', $page->title . ' - ADJ ARTS')

@section('content')
<div class="container page-container">
    <!-- Fil d'Ariane -->
    <nav class="page-breadcrumb">
        <a href="{{ route('home') }}" class="breadcrumb-link">Accueil</a>
        <span class="breadcrumb-separator">›</span>
        <span class="breadcrumb-current">{{ $page->title }}</span>
    </nav>

    <div class="page-layout">
        <div class="page-content-wrapper">
            <div class="page-card">
                <div class="page-card-body">
                    <h1 class="page-title">{{ $page->title }}</h1>
                    
                    <div class="page-content-enhanced">
                        {!! $page->content !!}
                    </div>

                    <!-- Section valeurs -->
                    <div class="values-section">
                        <div class="values-grid">
                            <div class="value-item">
                                <div class="value-icon-wrapper">
                                    <div class="value-icon">🤝</div>
                                </div>
                                <h4 class="value-title">Authenticité</h4>
                                <p class="value-description">Chaque produit raconte une histoire unique</p>
                            </div>
                            <div class="value-item">
                                <div class="value-icon-wrapper">
                                    <div class="value-icon">🌱</div>
                                </div>
                                <h4 class="value-title">Durabilité</h4>
                                <p class="value-description">Matériaux et méthodes respectueuses</p>
                            </div>
                            <div class="value-item">
                                <div class="value-icon-wrapper">
                                    <div class="value-icon">💝</div>
                                </div>
                                <h4 class="value-title">Empowerment</h4>
                                <p class="value-description">Autonomie des artisans africains</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Container principal */
.page-container {
    padding: 2rem 0;
}

/* Fil d'Ariane */
.page-breadcrumb {
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
}

.breadcrumb-link {
    color: var(--gold);
    text-decoration: none;
    transition: all 0.3s ease;
}

.breadcrumb-link:hover {
    opacity: 0.8;
    transform: translateY(-1px);
}

.breadcrumb-separator {
    color: var(--text-secondary);
}

.breadcrumb-current {
    color: var(--text-primary);
}

/* Layout */
.page-layout {
    display: flex;
    justify-content: center;
}

.page-content-wrapper {
    max-width: 800px;
    width: 100%;
}

/* Carte principale */
.page-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    transition: all 0.3s ease;
}

.page-card:hover {
    border-color: rgba(212, 175, 55, 0.4);
    transform: translateY(-2px);
    box-shadow: 0 12px 40px rgba(212, 175, 55, 0.1);
}

.page-card-body {
    padding: 3rem;
}

/* Titre de la page */
.page-title {
    color: var(--gold);
    text-align: center;
    margin-bottom: 3rem;
    font-size: 2.5rem;
    font-weight: 300;
    background: linear-gradient(135deg, var(--gold), #f8e6b4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
}

.page-title::after {
    content: '';
    position: absolute;
    bottom: -1rem;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

/* Contenu de la page */
.page-content-enhanced {
    line-height: 1.8;
    font-size: 1.1rem;
    color: var(--text-primary);
}

.page-content-enhanced h2 {
    color: var(--gold);
    margin: 2.5rem 0 1.5rem 0;
    font-size: 1.8rem;
    font-weight: 600;
    border-bottom: 1px solid rgba(212, 175, 55, 0.3);
    padding-bottom: 0.5rem;
}

.page-content-enhanced h3 {
    color: var(--pink);
    margin: 2rem 0 1rem 0;
    font-size: 1.4rem;
    font-weight: 500;
}

.page-content-enhanced p {
    margin-bottom: 1.5rem;
    color: var(--text-secondary);
}

.page-content-enhanced strong {
    color: var(--text-primary);
    font-weight: 600;
}

.page-content-enhanced ul, .page-content-enhanced ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

.page-content-enhanced li {
    margin-bottom: 0.5rem;
    color: var(--text-secondary);
}

.page-content-enhanced blockquote {
    border-left: 4px solid var(--gold);
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: var(--text-secondary);
    background: rgba(212, 175, 55, 0.05);
    padding: 1.5rem;
    border-radius: 0 8px 8px 0;
}

/* Section valeurs */
.values-section {
    margin-top: 4rem;
    padding-top: 3rem;
    border-top: 1px solid var(--border-color);
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.value-item {
    text-align: center;
    padding: 2rem 1rem;
    border-radius: 12px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid transparent;
}

.value-item:hover {
    background: rgba(212, 175, 55, 0.05);
    border-color: rgba(212, 175, 55, 0.2);
    transform: translateY(-5px);
}

.value-icon-wrapper {
    margin-bottom: 1.5rem;
}

.value-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: inline-block;
    transition: all 0.3s ease;
}

.value-item:hover .value-icon {
    transform: scale(1.1);
}

.value-title {
    color: var(--pink);
    margin-bottom: 1rem;
    font-size: 1.3rem;
    font-weight: 600;
}

.value-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.page-card {
    animation: fadeInUp 0.6s ease-out;
}

.value-item {
    animation: fadeInUp 0.6s ease-out;
}

.value-item:nth-child(1) { animation-delay: 0.1s; }
.value-item:nth-child(2) { animation-delay: 0.2s; }
.value-item:nth-child(3) { animation-delay: 0.3s; }

/* Responsive */
@media (max-width: 968px) {
    .page-card-body {
        padding: 2rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .values-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .page-container {
        padding: 1rem 0;
    }
    
    .page-card-body {
        padding: 1.5rem;
    }
    
    .page-title {
        font-size: 1.8rem;
        margin-bottom: 2rem;
    }
    
    .page-content-enhanced {
        font-size: 1rem;
    }
    
    .page-content-enhanced h2 {
        font-size: 1.5rem;
    }
    
    .page-content-enhanced h3 {
        font-size: 1.2rem;
    }
}

/* Effets de focus pour l'accessibilité */
.page-content-enhanced a {
    color: var(--gold);
    text-decoration: none;
    transition: all 0.3s ease;
}

.page-content-enhanced a:hover {
    text-decoration: underline;
    opacity: 0.8;
}

/* Style pour les tables */
.page-content-enhanced table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    overflow: hidden;
}

.page-content-enhanced th,
.page-content-enhanced td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.page-content-enhanced th {
    background: rgba(212, 175, 55, 0.1);
    color: var(--gold);
    font-weight: 600;
}

/* Style pour le code */
.page-content-enhanced code {
    background: rgba(255, 255, 255, 0.1);
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    color: var(--text-primary);
}

.page-content-enhanced pre {
    background: rgba(255, 255, 255, 0.05);
    padding: 1.5rem;
    border-radius: 8px;
    overflow-x: auto;
    margin: 1.5rem 0;
    border: 1px solid var(--border-color);
}

.page-content-enhanced pre code {
    background: none;
    padding: 0;
}
</style>

<script>
// Animation au scroll
document.addEventListener('DOMContentLoaded', function() {
    const pageCard = document.querySelector('.page-card');
    const valueItems = document.querySelectorAll('.value-item');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    // Observer la carte principale
    if (pageCard) {
        pageCard.style.opacity = '0';
        pageCard.style.transform = 'translateY(20px)';
        pageCard.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(pageCard);
    }
    
    // Observer les éléments de valeur
    valueItems.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = 'opacity 0.6s ease, transform 0.6s ease, all 0.3s ease';
        observer.observe(item);
    });
    
    // Animation des icônes au hover
    const valueIcons = document.querySelectorAll('.value-icon');
    valueIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.2) rotate(5deg)';
        });
        
        icon.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });
});
</script>
@endsection