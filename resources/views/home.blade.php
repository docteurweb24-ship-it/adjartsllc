@extends('layouts.app')

@section('title', 'ADJ ARTS - Artisanat Africain Authentique')

@section('content')
<div class="container">
    <!-- Hero Section avec textures -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <div class="logo-reveal">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="ADJ ARTS Logo" class="hero-logo"
                         onerror="this.src='https://via.placeholder.com/300x100/1a1a1a/D4AF37?text=ADJ+ARTS'">
                    <div class="title-underline"></div>
                </div>
                <p class="hero-subtitle">L'art, les yeux d'Afrique</p>
                <p class="hero-description">
                    Découvrez l'élégance intemporelle de l'artisanat africain, 
                    où chaque pièce raconte une histoire unique, sculptée avec passion 
                    et héritage culturel.
                </p>
                <div class="hero-actions">
                    <a href="/collections" class="btn-gold pulse-animation">Explorer les Collections</a>
                    <a href="/a-propos" class="btn-outline-gold">Notre Histoire</a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Artisans</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100+</span>
                        <span class="stat-label">Créations</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">10+</span>
                        <span class="stat-label">Pays</span>
                    </div>
                </div>
            </div>
            
            <!-- Slider -->
            @if(isset($featuredProducts) && count($featuredProducts) > 0)
            <div class="hero-slider">
                <div class="slider-container">
                    <div class="slider-track">
                        @foreach($featuredProducts as $product)
                        <div class="slide">
                            <div class="artwork-card">
                                <div class="artwork-image">
                                    @php
                                        $productImage = $product->images && is_array($product->images) && count($product->images) > 0 
                                            ? $product->images[0] 
                                            : null;
                                    @endphp
                                    
                                    @if($productImage)
                                        <img src="{{ Storage::url(is_array($productImage) ? ($productImage['path'] ?? $productImage) : $productImage) }}" 
                                             alt="{{ $product->name }}"
                                             class="artwork-img">
                                    @else
                                        <div class="artwork-placeholder">
                                            <span>ADJ ARTS</span>
                                        </div>
                                    @endif
                                    <div class="artwork-overlay">
                                        <div class="artwork-info">
                                            <h4>{{ $product->name }}</h4>
                                            <p class="artwork-price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                                            <a href="/produit/{{ $product->slug }}" class="btn-outline-gold">Découvrir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="slider-btn prev-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                        </svg>
                    </button>
                    <button class="slider-btn next-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                        </svg>
                    </button>
                </div>
            </div>
            @else
            <div class="hero-placeholder">
                <div class="placeholder-content">
                    <h3>Collections Exclusives</h3>
                    <p>Découvrez bientôt nos nouvelles créations</p>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Éléments décoratifs avec textures -->
        <div class="hero-decoration">
            <div class="floating-element element-1"></div>
            <div class="floating-element element-2"></div>
            <div class="floating-element element-3"></div>
            <div class="texture-pattern pattern-1"></div>
            <div class="texture-pattern pattern-2"></div>
        </div>
    </section>

    <!-- Section Collections avec Produits Vedettes -->
    <section class="collections-section">
        <div class="section-header">
            <h2 class="section-title">Nos Œuvres Exceptionnelles</h2>
            <p class="section-subtitle">Découvrez nos créations les plus remarquables</p>
        </div>
        
        <div class="collections-grid">
            @if(isset($featuredProducts) && count($featuredProducts) > 0)
                @foreach($featuredProducts as $product)
                <div class="collection-card">
                    <div class="collection-image">
                        @php
                            $productImage = $product->images && is_array($product->images) && count($product->images) > 0 
                                ? $product->images[0] 
                                : null;
                        @endphp
                        
                        @if($productImage)
                            <img src="{{ Storage::url(is_array($productImage) ? ($productImage['path'] ?? $productImage) : $productImage) }}" 
                                 alt="{{ $product->name }}"
                                 class="collection-img">
                        @else
                            <div class="collection-placeholder">
                                <span>ADJ ARTS</span>
                            </div>
                        @endif
                        <div class="collection-overlay">
                            <div class="collection-overlay-content">
                                <h4>{{ $product->name }}</h4>
                                <p class="collection-overlay-price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                                <a href="/produit/{{ $product->slug }}" class="btn-outline-gold">Voir les détails</a>
                            </div>
                        </div>
                    </div>
                    <div class="collection-content">
                        <h3>{{ $product->name }}</h3>
                        <p class="collection-category">{{ $product->category->name ?? 'Collection Premium' }}</p>
                        <div class="collection-meta">
                            <span class="collection-material">{{ $product->material ?? 'Bois précieux' }}</span>
                            <span class="collection-dimensions">{{ $product->dimensions ?: 'Sur mesure' }}</span>
                        </div>
                        <a href="/produit/{{ $product->slug }}" class="collection-link">
                            Découvrir cette œuvre
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="no-collections">
                    <div class="no-collections-icon">
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                        </svg>
                    </div>
                    <h3>Aucune œuvre vedette pour le moment</h3>
                    <p>Nos créations exceptionnelles seront bientôt disponibles</p>
                    <a href="/collections" class="btn-gold">Explorer toutes nos collections</a>
                </div>
            @endif
        </div>

        <div class="collections-cta">
            <a href="/collections" class="btn-outline-gold">
                Voir toutes nos œuvres
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                </svg>
            </a>
        </div>
    </section>

    <!-- Section Valeurs -->
    <section class="values-section">
        <div class="values-container">
            <div class="value-card">
                <div class="value-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                    </svg>
                </div>
                <h3>Authenticité</h3>
                <p>Chaque pièce est authentique, créée par des artisans africains avec des techniques ancestrales</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <h3>Qualité</h3>
                <p>Matériaux premium et finition exceptionnelle pour des œuvres qui traversent le temps</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C13.1 2 14 2.9 14 4S13.1 6 12 6 10 5.1 10 4 10.9 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <h3>Impact Social</h3>
                <p>Soutien direct aux communautés d'artisans et préservation du patrimoine culturel</p>
            </div>
        </div>
    </section>
</div>

<style>
/* Hero Section avec textures */
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 4rem 0;
    overflow: hidden;
}

/* Texture de fond labyrinthique */
.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        /* Texture labyrinthique dorée */
        radial-gradient(circle at 20% 50%, rgba(212, 175, 55, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 192, 203, 0.05) 0%, transparent 50%),
        /* Pattern géométrique africain moderne */
        repeating-linear-gradient(45deg, 
            transparent, 
            transparent 10px, 
            rgba(212, 175, 55, 0.03) 10px, 
            rgba(212, 175, 55, 0.03) 20px
        ),
        /* Texture supplémentaire */
        repeating-radial-gradient(circle at 50% 50%, 
            transparent 0, 
            transparent 10px, 
            rgba(212, 175, 55, 0.02) 10px, 
            rgba(212, 175, 55, 0.02) 20px
        );
    z-index: -1;
}

.hero-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    z-index: 2;
}

.hero-text {
    animation: fadeInUp 1s ease-out;
}

.logo-reveal {
    margin-bottom: 2rem;
    text-align: center;
}

.hero-logo {
    height: 120px;
    width: auto;
    margin: 0 auto 1rem;
    display: block;
    transition: transform 0.5s ease;
    object-fit: contain;
    animation: logoReveal 1.5s ease-out;
    filter: drop-shadow(0 10px 20px rgba(212, 175, 55, 0.3));
}

.hero-logo:hover {
    transform: scale(1.05);
}

.title-underline {
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, var(--gold), transparent);
    margin: 0 auto;
    animation: underlineExpand 1s ease-out 0.5s both;
}

.hero-subtitle {
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    opacity: 0.9;
    font-weight: 300;
    text-align: center;
    animation: fadeInUp 1s ease-out 0.3s both;
    color: var(--gold);
}

.hero-description {
    font-size: 1.2rem;
    line-height: 1.8;
    margin-bottom: 3rem;
    opacity: 0.8;
    max-width: 500px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    animation: fadeInUp 1s ease-out 0.6s both;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    margin-bottom: 3rem;
    justify-content: center;
    animation: fadeInUp 1s ease-out 0.9s both;
}

.hero-stats {
    display: flex;
    gap: 3rem;
    justify-content: center;
    animation: fadeInUp 1s ease-out 1.2s both;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: bold;
    color: var(--gold);
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.7;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Slider Styles */
.hero-slider {
    position: relative;
    animation: fadeInRight 1s ease-out;
}

.slider-container {
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    background: linear-gradient(135deg, var(--bg-card), var(--bg-secondary));
}

.slider-track {
    display: flex;
    transition: transform 0.5s ease;
}

.slide {
    min-width: 100%;
    padding: 1rem;
}

.artwork-card {
    background: var(--bg-card);
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid var(--border-color);
}

.artwork-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(212, 175, 55, 0.2);
}

.artwork-image {
    position: relative;
    height: 400px;
    overflow: hidden;
}

.artwork-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.artwork-card:hover .artwork-img {
    transform: scale(1.05);
}

.artwork-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--bg-secondary), var(--border-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 1.5rem;
    font-weight: bold;
}

.artwork-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    display: flex;
    align-items: flex-end;
    padding: 2rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.artwork-card:hover .artwork-overlay {
    opacity: 1;
}

.artwork-info h4 {
    color: white;
    margin-bottom: 0.5rem;
    font-size: 1.3rem;
}

.artwork-price {
    color: var(--gold);
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
}

.slider-controls {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    padding: 0 1rem;
}

.slider-btn {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid var(--border-color);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    cursor: pointer;
    transition: all 0.3s ease;
}

.slider-btn:hover {
    background: var(--gold);
    color: black;
    transform: scale(1.1);
}

/* Placeholder */
.hero-placeholder {
    background: var(--bg-card);
    border-radius: 20px;
    padding: 4rem 2rem;
    text-align: center;
    border: 1px solid var(--border-color);
    background: linear-gradient(135deg, var(--bg-card), var(--bg-secondary));
}

.placeholder-content h3 {
    color: var(--gold);
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.placeholder-content p {
    opacity: 0.8;
}

/* Collections Section avec texture - MAINTENANT AVEC PRODUITS VEDETTES */
.collections-section {
    padding: 6rem 0;
    position: relative;
    background: var(--bg-secondary);
    border-radius: 30px;
    margin: 4rem 0;
}

.collections-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        repeating-linear-gradient(-45deg, 
            transparent, 
            transparent 20px, 
            rgba(212, 175, 55, 0.02) 20px, 
            rgba(212, 175, 55, 0.02) 40px
        );
    border-radius: 30px;
    pointer-events: none;
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
    position: relative;
    z-index: 2;
}

.section-title {
    font-size: 3rem;
    color: var(--gold);
    margin-bottom: 1rem;
    font-weight: 300;
    text-shadow: 0 2px 10px rgba(212, 175, 55, 0.2);
}

.section-subtitle {
    font-size: 1.3rem;
    opacity: 0.8;
}

.collections-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2.5rem;
    position: relative;
    z-index: 2;
    margin-bottom: 3rem;
}

.collection-card {
    background: var(--bg-card);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.collection-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(212, 175, 55, 0.15);
    border-color: rgba(212, 175, 55, 0.4);
}

.collection-image {
    position: relative;
    height: 280px;
    overflow: hidden;
}

.collection-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.collection-card:hover .collection-img {
    transform: scale(1.05);
}

.collection-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--bg-secondary), var(--border-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 1.3rem;
    font-weight: bold;
    position: relative;
}

.collection-placeholder::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at center, rgba(212, 175, 55, 0.1) 0%, transparent 70%);
}

.collection-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    display: flex;
    align-items: flex-end;
    padding: 2rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.collection-card:hover .collection-overlay {
    opacity: 1;
}

.collection-overlay-content h4 {
    color: white;
    margin-bottom: 0.5rem;
    font-size: 1.2rem;
}

.collection-overlay-price {
    color: var(--gold);
    font-size: 1.3rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
}

.collection-content {
    padding: 1.5rem;
}

.collection-content h3 {
    margin-bottom: 0.5rem;
    font-size: 1.3rem;
    color: var(--text-primary);
    font-weight: 600;
}

.collection-category {
    color: var(--gold);
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.collection-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.collection-material, .collection-dimensions {
    font-size: 0.85rem;
    color: var(--text-secondary);
    opacity: 0.8;
}

.collection-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--gold);
    text-decoration: none;
    font-weight: 600;
    transition: gap 0.3s ease;
}

.collection-link:hover {
    gap: 1rem;
}

.no-collections {
    text-align: center;
    padding: 4rem 2rem;
    grid-column: 1 / -1;
}

.no-collections-icon {
    color: var(--gold);
    margin-bottom: 1.5rem;
    opacity: 0.7;
}

.no-collections h3 {
    color: var(--text-primary);
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.no-collections p {
    opacity: 0.7;
    margin-bottom: 2rem;
}

.collections-cta {
    text-align: center;
    position: relative;
    z-index: 2;
}

/* Values Section avec texture */
.values-section {
    padding: 6rem 0;
    background: var(--bg-secondary);
    border-radius: 30px;
    margin: 4rem 0;
    position: relative;
    overflow: hidden;
}

.values-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        repeating-radial-gradient(circle at 20% 30%, 
            rgba(212, 175, 55, 0.05) 0%, 
            transparent 50px, 
            rgba(212, 175, 55, 0.03) 50px, 
            transparent 100px
        );
}

.values-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 3rem;
    max-width: 1000px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.value-card {
    text-align: center;
    padding: 3rem 2rem;
    background: var(--bg-card);
    border-radius: 20px;
    transition: transform 0.3s ease;
    border: 1px solid var(--border-color);
    backdrop-filter: blur(10px);
}

.value-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(212, 175, 55, 0.1);
}

.value-icon {
    color: var(--gold);
    margin-bottom: 2rem;
    filter: drop-shadow(0 5px 15px rgba(212, 175, 55, 0.3));
}

.value-card h3 {
    margin-bottom: 1rem;
    font-size: 1.5rem;
    color: var(--gold);
}

.value-card p {
    opacity: 0.8;
    line-height: 1.6;
}

/* Éléments décoratifs avec textures */
.hero-decoration {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    z-index: 1;
}

.floating-element {
    position: absolute;
    background: rgba(212, 175, 55, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
    backdrop-filter: blur(5px);
}

.element-1 {
    width: 100px;
    height: 100px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.element-2 {
    width: 150px;
    height: 150px;
    bottom: 30%;
    right: 15%;
    animation-delay: 2s;
}

.element-3 {
    width: 80px;
    height: 80px;
    top: 60%;
    left: 5%;
    animation-delay: 4s;
}

.texture-pattern {
    position: absolute;
    opacity: 0.1;
}

.pattern-1 {
    top: 10%;
    right: 10%;
    width: 200px;
    height: 200px;
    background: 
        repeating-linear-gradient(45deg, 
            var(--gold), 
            var(--gold) 2px, 
            transparent 2px, 
            transparent 10px
        );
    animation: rotate 20s linear infinite;
}

.pattern-2 {
    bottom: 10%;
    left: 10%;
    width: 150px;
    height: 150px;
    background: 
        radial-gradient(circle, var(--gold) 1px, transparent 1px);
    background-size: 20px 20px;
    animation: pulse 4s ease-in-out infinite;
}

/* Animations */
@keyframes logoReveal {
    from {
        opacity: 0;
        transform: scale(0.8) translateY(-20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

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

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes underlineExpand {
    from {
        width: 0;
    }
    to {
        width: 100px;
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
    }
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

@keyframes pulse {
    0%, 100% {
        opacity: 0.1;
        transform: scale(1);
    }
    50% {
        opacity: 0.2;
        transform: scale(1.1);
    }
}

@keyframes pulse-animation {
    0% {
        box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(212, 175, 55, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(212, 175, 55, 0);
    }
}

.pulse-animation {
    animation: pulse-animation 2s infinite;
}

/* Responsive */
@media (max-width: 968px) {
    .hero-content {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .hero-logo {
        height: 100px;
    }
    
    .hero-actions {
        justify-content: center;
    }
    
    .hero-stats {
        justify-content: center;
    }
    
    .section-title {
        font-size: 2.5rem;
    }
    
    .collections-grid {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }
}

@media (max-width: 768px) {
    .hero-logo {
        height: 80px;
    }
    
    .hero-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .collections-grid {
        grid-template-columns: 1fr;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .values-container {
        grid-template-columns: 1fr;
    }
    
    .collections-section, .values-section {
        margin: 2rem 0;
        padding: 4rem 0;
    }
    
    .collection-image {
        height: 250px;
    }
}
</style>

<script>
// Script complet avec gestion d'erreurs
document.addEventListener('DOMContentLoaded', function() {
    console.log('ADJ ARTS - Page d\'accueil chargée');
    
    // Slider functionality
    try {
        const track = document.querySelector('.slider-track');
        const slides = document.querySelectorAll('.slide');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        
        if (track && slides.length > 0) {
            let currentSlide = 0;
            
            function updateSlider() {
                track.style.transform = `translateX(-${currentSlide * 100}%)`;
            }
            
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    currentSlide = (currentSlide + 1) % slides.length;
                    updateSlider();
                });
            }
            
            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                    updateSlider();
                });
            }
            
            // Auto-slide
            setInterval(() => {
                currentSlide = (currentSlide + 1) % slides.length;
                updateSlider();
            }, 5000);
        }
    } catch (error) {
        console.log('Slider non disponible:', error);
    }
    
    // Animation on scroll
    try {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);
        
        // Observe animated elements
        document.querySelectorAll('.collection-card, .value-card').forEach(el => {
            el.style.animation = 'fadeInUp 0.6s ease-out both';
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });
    } catch (error) {
        console.log('Animation scroll non disponible:', error);
    }
});
</script>
@endsection