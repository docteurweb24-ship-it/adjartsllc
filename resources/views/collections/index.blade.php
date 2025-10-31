@extends('layouts.app')

@section('title', 'Collections - ADJ ARTS')

@section('content')
<div class="container">
    <!-- Hero Section Collections -->
    <section class="collections-hero">
        <h1 class="collections-title">Nos Collections</h1>
        <p class="collections-subtitle">
            Découvrez l'excellence de l'artisanat africain
        </p>
    </section>

    <div class="collections-layout">
        <!-- Filtres Sidebar -->
        <div class="filters-sidebar">
            <h3 class="filters-title">
                Filtres
            </h3>
            
            <!-- Catégories -->
            <div class="filter-section">
                <h4 class="filter-section-title">Catégories</h4>
                <div class="filter-links">
                    <a href="?category=all" class="filter-link {{ !request('category') || request('category') == 'all' ? 'active' : '' }}">
                       Toutes les collections
                    </a>
                    @foreach($categories as $category)
                    <a href="?category={{ $category->slug }}" class="filter-link {{ request('category') == $category->slug ? 'active' : '' }}">
                       {{ $category->name }} <span class="product-count">({{ $category->products_count }})</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Prix -->
            <div class="filter-section">
                <h4 class="filter-section-title">Budget</h4>
                <div class="filter-links">
                    <a href="?price_range=0-50000" class="filter-link {{ request('price_range') == '0-50000' ? 'active' : '' }}">
                       Moins de 50.000 FCFA
                    </a>
                    <a href="?price_range=50000-100000" class="filter-link {{ request('price_range') == '50000-100000' ? 'active' : '' }}">
                       50.000 - 100.000 FCFA
                    </a>
                    <a href="?price_range=100000+" class="filter-link {{ request('price_range') == '100000+' ? 'active' : '' }}">
                       Plus de 100.000 FCFA
                    </a>
                </div>
            </div>

            <!-- Reset -->
            <a href="/collections" class="btn-reset-filters">
                Réinitialiser
            </a>
        </div>

        <!-- Produits -->
        <div class="products-main">
            <!-- En-tête -->
            <div class="products-header">
                <p class="products-count">
                    <strong>{{ $products->total() }}</strong> œuvre(s) d'art trouvée(s)
                </p>
                <select class="sort-select">
                    <option>Trier par : Nouveautés</option>
                    <option>Trier par : Prix croissant</option>
                    <option>Trier par : Prix décroissant</option>
                </select>
            </div>

            <!-- Grille Produits -->
            <div class="products-grid-enhanced">
                @forelse($products as $product)
                <div class="product-card-enhanced">
                    <!-- CORRECTION DES IMAGES -->
                    @if($product->main_image)
                        <img src="{{ asset('storage/' . $product->main_image) }}" 
                             alt="{{ $product->name }}" 
                             class="product-image-enhanced">
                    @else
                        <img src="https://via.placeholder.com/400x400/1a1a1a/D4AF37?text=ADJ+ARTS" 
                             alt="{{ $product->name }}" 
                             class="product-image-enhanced">
                    @endif
                    
                    <div class="product-info-enhanced">
                        @if($product->featured)
                        <span class="featured-badge">
                            Produit Vedette
                        </span>
                        @endif
                        
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-price">
                            {{ number_format($product->price, 0, ',', ' ') }} FCFA
                        </p>
                        <p class="product-material">
                            Matériau : {{ $product->material }}
                        </p>
                        <p class="product-description">
                            {{ Str::limit($product->description, 120) }}
                        </p>
                        
                        <div class="product-actions">
                            <a href="/produit/{{ $product->slug }}" class="btn-details">
                                Voir détails
                            </a>
                            @if($product->amazon_link)
                            <a href="{{ $product->amazon_link }}" target="_blank" class="btn-buy">
                                Acheter
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="no-products">
                    <h3>Aucune œuvre trouvée</h3>
                    <p>
                        Essayez de modifier vos critères de recherche pour découvrir nos trésors
                    </p>
                    <a href="/collections" class="btn-view-all">Voir toutes les collections</a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="pagination-container">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Hero Section */
.collections-hero {
    text-align: center;
    padding: 4rem 0 3rem;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), transparent);
    border-radius: 0 0 20px 20px;
    margin-bottom: 2rem;
}

.collections-title {
    font-size: 3rem;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, var(--gold), #f8e6b4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.collections-subtitle {
    font-size: 1.3rem;
    margin-bottom: 2rem;
    color: var(--text-secondary);
}

/* Layout */
.collections-layout {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 2.5rem;
    align-items: start;
}

/* Filtres Sidebar */
.filters-sidebar {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.5rem;
    position: sticky;
    top: 120px;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.filters-title {
    color: var(--gold);
    margin-bottom: 1.5rem;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 0.5rem;
    font-size: 1.3rem;
}

.filter-section {
    margin-bottom: 2rem;
}

.filter-section-title {
    color: var(--pink);
    margin-bottom: 1rem;
    font-size: 1.1rem;
    font-weight: 600;
}

.filter-links {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
}

.filter-link {
    text-decoration: none;
    padding: 0.8rem 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    color: var(--text-secondary);
    border-left: 3px solid transparent;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.filter-link:hover {
    background: rgba(212, 175, 55, 0.05);
    color: var(--text-primary);
    transform: translateX(5px);
}

.filter-link.active {
    background: rgba(212, 175, 55, 0.1);
    border-left: 3px solid var(--gold);
    color: var(--gold);
}

.product-count {
    opacity: 0.7;
    font-size: 0.8rem;
}

.btn-reset-filters {
    display: block;
    text-align: center;
    margin-top: 1rem;
    padding: 0.8rem;
    background: transparent;
    color: var(--gold);
    border: 2px solid var(--gold);
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 600;
}

.btn-reset-filters:hover {
    background: rgba(212, 175, 55, 0.1);
    transform: translateY(-2px);
}

/* Produits Main */
.products-main {
    flex: 1;
}

.products-header {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    backdrop-filter: blur(10px);
}

.products-count {
    font-size: 1.1rem;
    color: var(--text-primary);
}

.sort-select {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    color: var(--text-primary);
    padding: 0.7rem 1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.sort-select:hover {
    border-color: var(--gold);
}

/* Grille Produits */
.products-grid-enhanced {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
}

.product-card-enhanced {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.product-card-enhanced:hover {
    transform: translateY(-5px);
    border-color: rgba(212, 175, 55, 0.4);
    box-shadow: 0 8px 30px rgba(212, 175, 55, 0.2);
}

.product-image-enhanced {
    width: 100%;
    height: 250px;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}

.product-card-enhanced:hover .product-image-enhanced {
    transform: scale(1.05);
}

.product-info-enhanced {
    padding: 1.5rem;
}

.featured-badge {
    background: linear-gradient(135deg, var(--gold), #b8941f);
    color: black;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: bold;
    display: inline-block;
    margin-bottom: 0.8rem;
}

.product-name {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-size: 1.2rem;
    line-height: 1.4;
}

.product-price {
    color: var(--gold);
    font-size: 1.4rem;
    font-weight: bold;
    margin: 1rem 0;
    text-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
}

.product-material {
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    opacity: 0.9;
}

.product-description {
    color: var(--text-secondary);
    margin-bottom: 1rem;
    opacity: 0.8;
    font-size: 0.9rem;
    line-height: 1.4;
}

.product-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
}

.btn-details {
    flex: 1;
    text-align: center;
    padding: 0.7rem;
    background: transparent;
    color: var(--gold);
    border: 2px solid var(--gold);
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 600;
}

.btn-details:hover {
    background: rgba(212, 175, 55, 0.1);
}

.btn-buy {
    padding: 0.7rem 1.2rem;
    background: linear-gradient(135deg, var(--gold), #b8941f);
    color: black;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 600;
}

.btn-buy:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
}

/* Aucun produit */
.no-products {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
}

.no-products h3 {
    color: var(--gold);
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.no-products p {
    color: var(--text-secondary);
    margin-bottom: 2rem;
    opacity: 0.9;
}

.btn-view-all {
    background: linear-gradient(135deg, var(--gold), #b8941f);
    color: black;
    padding: 1rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 600;
}

.btn-view-all:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
}

/* Pagination */
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
    padding: 1.5rem;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
}

/* Responsive */
@media (max-width: 968px) {
    .collections-layout {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .filters-sidebar {
        position: static;
        order: 2;
    }
    
    .products-main {
        order: 1;
    }
    
    .products-header {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .sort-select {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .collections-title {
        font-size: 2.5rem;
    }
    
    .products-grid-enhanced {
        grid-template-columns: 1fr;
    }
    
    .product-actions {
        flex-direction: column;
    }
}

/* Animation pour les cartes */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.product-card-enhanced {
    animation: fadeInUp 0.6s ease-out;
}
</style>

<script>
// Animation au scroll pour les produits
document.addEventListener('DOMContentLoaded', function() {
    const productCards = document.querySelectorAll('.product-card-enhanced');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    productCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>
@endsection