@extends('layouts.app')

@section('title', $product->name . ' - ADJ ARTS')

@section('content')
<div class="container">
    <!-- Fil d'Ariane -->
    <nav class="breadcrumb-custom">
        <a href="/" class="text-gold">Accueil</a>
        <span class="text-cream">›</span>
        <a href="/collections" class="text-gold">Collections</a>
        <span class="text-cream">›</span>
        <span class="text-cream">{{ $product->name }}</span>
    </nav>

    <div class="product-detail-grid">
        <!-- Galerie Produit -->
        <div class="gallery-section">
            <div class="main-image-container">
                @php
                    $mainImage = $product->images && is_array($product->images) && count($product->images) > 0 
                        ? $product->images[0] 
                        : null;
                @endphp
                
                @if($mainImage)
                    <img src="{{ Storage::url(is_array($mainImage) ? ($mainImage['path'] ?? $mainImage) : $mainImage) }}" 
                         alt="{{ $product->name }}" 
                         class="main-product-image">
                @else
                    <div class="image-placeholder">
                        <div class="placeholder-content">
                            <div class="placeholder-icon">
                                <svg width="60" height="60" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                </svg>
                            </div>
                            <span>ADJ ARTS</span>
                            <p>Image non disponible</p>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Miniatures -->
            @if($product->images && is_array($product->images) && count($product->images) > 1)
            <div class="thumbnails-grid">
                @foreach($product->images as $index => $image)
                <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url(is_array($image) ? ($image['path'] ?? $image) : $image) }}" 
                         alt="{{ $product->name }} - Vue {{ $index + 1 }}">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Informations Produit -->
        <div class="product-info-section">
            @if($product->featured)
            <span class="featured-badge">
                Œuvre Exclusive
            </span>
            @endif
            
            <h1 class="product-title-custom">{{ $product->name }}</h1>
            
            <p class="product-price-custom">
                {{ number_format($product->price, 0, ',', ' ') }} FCFA
            </p>

            <!-- Métadonnées -->
            <div class="metadata-grid-custom">
                <div class="metadata-item">
                    <div class="metadata-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C13.1 2 14 2.9 14 4S13.1 6 12 6 10 5.1 10 4 10.9 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="metadata-label">Matériau</p>
                        <p class="metadata-value">{{ $product->material ?? 'Bois précieux' }}</p>
                    </div>
                </div>
                
                <div class="metadata-item">
                    <div class="metadata-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 16.5c0 .38-.21.71-.53.88l-7.9 4.44c-.16.12-.36.18-.57.18s-.41-.06-.57-.18l-7.9-4.44A.991.991 0 013 16.5v-9c0-.38.21-.71.53-.88l7.9-4.44c.16-.12.36-.18.57-.18s.41.06.57.18l7.9 4.44c.32.17.53.5.53.88v9z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="metadata-label">Dimensions</p>
                        <p class="metadata-value">{{ $product->dimensions ?: 'Sur mesure' }}</p>
                    </div>
                </div>
                
                <div class="metadata-item">
                    <div class="metadata-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="metadata-label">Stock</p>
                        <p class="metadata-value {{ $product->stock > 0 ? 'stock-available' : 'stock-preorder' }}">
                            @if($product->stock > 0)
                                Disponible ({{ $product->stock }})
                            @else
                                Production sur commande
                            @endif
                        </p>
                    </div>
                </div>
                
                <div class="metadata-item">
                    <div class="metadata-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="metadata-label">Collection</p>
                        <p class="metadata-value">{{ $product->category->name ?? 'Non catégorisé' }}</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="description-section-custom">
                <h3 class="description-title">Histoire de l'œuvre</h3>
                <p class="product-description">{{ $product->description ?? 'Cette œuvre unique incarne l\'essence de l\'artisanat africain traditionnel, créée avec passion et expertise par nos artisans.' }}</p>
            </div>

            <!-- Actions -->
            <div class="action-buttons-custom">
                @if($product->amazon_link)
                <a href="{{ $product->amazon_link }}" target="_blank" class="btn-amazon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px;">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                    Acheter sur Amazon
                </a>
                @endif
                <a href="https://wa.me/229XXXXXXXXX?text=Bonjour%20ADJ%20ARTS!%20Je%20suis%20intéressé(e)%20par%20{{ urlencode($product->name) }}%20({{ number_format($product->price, 0, ',', ' ') }}%20FCFA)" 
                   target="_blank" 
                   class="btn-whatsapp">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px;">
                        <path d="M16.75 13.96c.25.13.41.2.46.3.06.11.04.61.21 1.18.2.57.46 1.3.52 1.44.06.14.1.28.15.42.05.14.06.3.04.44-.02.14-.08.27-.17.39-.09.12-.2.24-.32.34-.12.1-.24.19-.37.27-.13.08-.27.15-.42.2-.15.05-.3.08-.45.09-.15.01-.3 0-.45-.01-.15-.02-.3-.05-.45-.1-.15-.05-.3-.11-.45-.18-.13-.07-.26-.15-.38-.24-.12-.09-.24-.19-.35-.3-.11-.11-.21-.23-.31-.36-.1-.13-.19-.27-.27-.41-.08-.14-.15-.29-.21-.44-.06-.15-.11-.3-.15-.46-.04-.16-.07-.32-.09-.48-.02-.16-.03-.32-.03-.48 0-.16.01-.32.03-.48.02-.16.05-.32.09-.48.04-.16.09-.31.15-.46.06-.15.13-.3.21-.44.08-.14.17-.28.27-.41.1-.13.2-.25.31-.36.11-.11.23-.21.35-.3.12-.09.25-.17.38-.24.15-.07.3-.13.45-.18.15-.05.3-.08.45-.1.15-.02.3-.02.45-.01.15.01.3.04.45.09.15.05.29.12.42.2.13.08.25.17.37.27.12.1.23.22.32.34.09.12.15.25.17.39.02.14.01.3-.04.44-.05.14-.09.28-.15.42-.06.14-.32.87-.52 1.44-.17.57-.15 1.07-.21 1.18-.05.1-.21.17-.46.3z"/>
                    </svg>
                    Commander sur WhatsApp
                </a>
            </div>

            <!-- Garanties -->
            <div class="guarantees-grid">
                <div class="guarantee-item">
                    <div class="guarantee-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                        </svg>
                    </div>
                    <p class="guarantee-text">Livraison Internationale</p>
                </div>
                <div class="guarantee-item">
                    <div class="guarantee-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <p class="guarantee-text">Artisanat Authentique</p>
                </div>
                <div class="guarantee-item">
                    <div class="guarantee-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <p class="guarantee-text">Impact Social</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Produits Similaires -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <section class="related-products-section">
        <h2 class="related-title">
            Œuvres Similaires
        </h2>
        <div class="related-products-grid">
            @foreach($relatedProducts as $relatedProduct)
            <div class="related-product-card">
                @php
                    $relatedImage = $relatedProduct->images && is_array($relatedProduct->images) && count($relatedProduct->images) > 0 
                        ? $relatedProduct->images[0] 
                        : null;
                @endphp
                
                @if($relatedImage)
                    <img src="{{ Storage::url(is_array($relatedImage) ? ($relatedImage['path'] ?? $relatedImage) : $relatedImage) }}" 
                         alt="{{ $relatedProduct->name }}" 
                         class="related-product-image">
                @else
                    <div class="related-image-placeholder">
                        <div class="placeholder-content">
                            <span>ADJ ARTS</span>
                        </div>
                    </div>
                @endif
                
                <div class="related-product-info">
                    <h3 class="related-product-name">{{ $relatedProduct->name }}</h3>
                    <p class="related-product-price">
                        {{ number_format($relatedProduct->price, 0, ',', ' ') }} FCFA
                    </p>
                    <a href="/produit/{{ $relatedProduct->slug }}" class="btn-related">
                        Découvrir
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>

<style>
/* Variables ADJ ARTS */
:root {
    --gold: #D4AF37;
    --gold-light: #f4e4a9;
    --pink: #FFC0CB;
    --black: #000000;
    --dark-bg: #0a0a0a;
    --dark-light: #1a1a1a;
    --cream: #f8f4e9;
    --text-dark: #2d3748;
    --border-color: rgba(212, 175, 55, 0.2);
}

/* Layout Principal */
.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

.breadcrumb-custom {
    margin: 2rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
}

.breadcrumb-custom a {
    color: var(--gold);
    text-decoration: none;
    transition: all 0.3s ease;
}

.breadcrumb-custom a:hover {
    opacity: 0.8;
}

.product-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: start;
    margin: 3rem 0;
}

/* Galerie Produit */
.gallery-section {
    position: sticky;
    top: 120px;
}

.main-image-container {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
    background: var(--dark-light);
}

.main-image-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 80px rgba(212, 175, 55, 0.2);
}

.main-product-image {
    width: 100%;
    height: 600px;
    object-fit: cover;
    display: block;
}

.image-placeholder {
    width: 100%;
    height: 600px;
    background: linear-gradient(135deg, var(--dark-bg), var(--dark-light));
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.placeholder-content {
    text-align: center;
    color: var(--gold);
}

.placeholder-icon {
    margin-bottom: 1rem;
    opacity: 0.7;
}

.placeholder-content span {
    font-size: 1.5rem;
    font-weight: bold;
    display: block;
    margin-bottom: 0.5rem;
}

.placeholder-content p {
    font-size: 0.9rem;
    opacity: 0.7;
}

.thumbnails-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-top: 1.5rem;
}

.thumbnail-item {
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    height: 80px;
    background: var(--dark-light);
}

.thumbnail-item:hover,
.thumbnail-item.active {
    border-color: var(--gold);
    transform: translateY(-2px);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Section Informations Produit */
.product-info-section {
    background: linear-gradient(135deg, var(--dark-light), rgba(26, 26, 26, 0.9));
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 3rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.product-info-section:hover {
    border-color: rgba(212, 175, 55, 0.4);
}

.featured-badge {
    background: linear-gradient(135deg, var(--gold), var(--gold-light));
    color: black;
    padding: 0.6rem 1.5rem;
    border-radius: 25px;
    font-weight: bold;
    display: inline-block;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-title-custom {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    line-height: 1.2;
    background: linear-gradient(135deg, var(--cream), var(--gold));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 300;
}

.product-price-custom {
    font-size: 2.8rem;
    font-weight: bold;
    margin-bottom: 2rem;
    color: var(--gold);
    text-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
}

/* Métadonnées */
.metadata-grid-custom {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2.5rem;
    padding: 2rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

.metadata-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.metadata-icon {
    color: var(--gold);
    flex-shrink: 0;
}

.metadata-label {
    color: var(--cream);
    font-weight: 600;
    margin-bottom: 0.3rem;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.metadata-value {
    color: var(--cream);
    font-size: 1rem;
    opacity: 0.9;
}

.stock-available {
    color: #25D366;
    font-weight: bold;
}

.stock-preorder {
    color: var(--pink);
    font-weight: bold;
}

/* Description */
.description-section-custom {
    margin-bottom: 2.5rem;
    padding: 2rem 0;
    border-top: 1px solid var(--border-color);
    border-bottom: 1px solid var(--border-color);
}

.description-title {
    color: var(--gold);
    margin-bottom: 1.5rem;
    font-size: 1.4rem;
    font-weight: 600;
}

.product-description {
    line-height: 1.8;
    font-size: 1.1rem;
    color: var(--cream);
    opacity: 0.9;
}

/* Boutons d'Action */
.action-buttons-custom {
    display: flex;
    gap: 1rem;
    margin-bottom: 2.5rem;
}

.btn-amazon, .btn-whatsapp {
    flex: 1;
    text-align: center;
    font-size: 1.1rem;
    padding: 1.2rem 1.5rem;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-amazon {
    background: linear-gradient(135deg, var(--gold), #b8941f);
    color: black;
    border: none;
}

.btn-amazon:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
}

.btn-whatsapp {
    background: transparent;
    color: var(--gold);
    border: 2px solid var(--gold);
}

.btn-whatsapp:hover {
    background: rgba(212, 175, 55, 0.1);
    transform: translateY(-3px);
}

/* Garanties */
.guarantees-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    text-align: center;
    padding-top: 2.5rem;
    border-top: 1px solid var(--border-color);
}

.guarantee-item {
    padding: 1.5rem 1rem;
    border-radius: 10px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.05);
}

.guarantee-item:hover {
    background: rgba(212, 175, 55, 0.1);
    transform: translateY(-2px);
}

.guarantee-icon {
    color: var(--gold);
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.guarantee-item:hover .guarantee-icon {
    transform: scale(1.1);
}

.guarantee-text {
    font-size: 0.9rem;
    color: var(--cream);
    font-weight: 500;
}

/* Produits Similaires */
.related-products-section {
    margin: 6rem 0;
    padding: 4rem 0;
    border-top: 1px solid var(--border-color);
}

.related-title {
    text-align: center;
    margin-bottom: 4rem;
    font-size: 2.5rem;
    color: var(--gold);
    background: linear-gradient(135deg, var(--gold), var(--gold-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 300;
}

.related-products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2.5rem;
}

.related-product-card {
    background: linear-gradient(135deg, var(--dark-light), rgba(26, 26, 26, 0.9));
    border: 1px solid var(--border-color);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.related-product-card:hover {
    transform: translateY(-8px);
    border-color: rgba(212, 175, 55, 0.4);
    box-shadow: 0 25px 60px rgba(212, 175, 55, 0.2);
}

.related-product-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    display: block;
}

.related-image-placeholder {
    width: 100%;
    height: 250px;
    background: linear-gradient(135deg, var(--dark-bg), var(--dark-light));
    display: flex;
    align-items: center;
    justify-content: center;
}

.related-image-placeholder .placeholder-content span {
    color: var(--gold);
    font-size: 1.2rem;
    font-weight: bold;
}

.related-product-info {
    padding: 2rem;
}

.related-product-name {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    color: var(--cream);
    font-weight: 600;
}

.related-product-price {
    font-size: 1.4rem;
    font-weight: bold;
    margin: 1.5rem 0;
    color: var(--gold);
}

.btn-related {
    display: block;
    text-align: center;
    padding: 1rem;
    background: transparent;
    color: var(--gold);
    border: 2px solid var(--gold);
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-related:hover {
    background: rgba(212, 175, 55, 0.1);
    transform: translateY(-2px);
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

/* Responsive */
@media (max-width: 968px) {
    .product-detail-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .gallery-section {
        position: static;
    }
    
    .main-product-image {
        height: 400px;
    }
    
    .action-buttons-custom {
        flex-direction: column;
    }
    
    .metadata-grid-custom {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 0 1rem;
    }
    
    .guarantees-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .thumbnails-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .product-title-custom {
        font-size: 2rem;
    }
    
    .product-price-custom {
        font-size: 2.2rem;
    }
    
    .related-products-grid {
        grid-template-columns: 1fr;
    }
    
    .product-info-section {
        padding: 2rem;
    }
}

/* Améliorations visuelles */
.glass-effect {
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.text-gold { color: var(--gold); }
.text-cream { color: var(--cream); }
.text-pink { color: var(--pink); }
</style>

<script>
// Script pour la galerie d'images
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    const mainImage = document.querySelector('.main-product-image');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Retirer la classe active de toutes les miniatures
            thumbnails.forEach(t => t.classList.remove('active'));
            // Ajouter la classe active à la miniature cliquée
            this.classList.add('active');
            // Changer l'image principale
            const newSrc = this.querySelector('img').src;
            mainImage.src = newSrc;
        });
    });
    
    // Animation au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease-out both';
            }
        });
    }, observerOptions);
    
    // Observer les éléments à animer
    document.querySelectorAll('.product-info-section, .related-product-card').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection