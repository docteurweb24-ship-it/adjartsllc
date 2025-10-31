@extends('admin.layout')

@section('title', 'Tableau de Bord')

@section('content')
    <!-- Header -->
    <div class="admin-header">
        <div>
            <h1>Tableau de Bord</h1>
            <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                Bienvenue dans l'administration ADJ ARTS
            </p>
        </div>
        <div class="header-actions">
            <div style="color: var(--text-secondary); background: rgba(212, 175, 55, 0.1); padding: 0.5rem 1rem; border-radius: 25px; border: 1px solid var(--border-color);">
                {{ now()->translatedFormat('l d F Y - H:i') }}
            </div>
        </div>
    </div>

    <!-- Statistiques Principales -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $stats['products_count'] ?? 0 }}</div>
            <div class="stat-label">Produits</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['categories_count'] ?? 0 }}</div>
            <div class="stat-label">Collections</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['blog_posts_count'] ?? 0 }}</div>
            <div class="stat-label">Articles Blog</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['featured_products'] ?? 0 }}</div>
            <div class="stat-label">Produits Vedettes</div>
        </div>
    </div>

    <!-- Actions Rapides -->
    <div class="admin-card">
        <h2 style="color: var(--admin-gold); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
            Actions Rapides
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            <a href="{{ route('admin.products.create') }}" class="btn-admin">
                Nouveau Produit
            </a>
            <a href="{{ route('admin.blog-posts.create') }}" class="btn-admin">
                Nouvel Article
            </a>
            <a href="{{ route('admin.pages.create') }}" class="btn-admin">
                Nouvelle Page
            </a>
            <a href="{{ route('admin.promotions.create') }}" class="btn-admin">
                Nouvelle Promotion
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        <!-- Derniers Produits -->
        <div class="admin-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h2 style="color: var(--admin-gold);">Derniers Produits</h2>
                <a href="{{ route('admin.products.index') }}" class="btn-outline-admin">
                    Voir tout
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Collection</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $recentProducts = \App\Models\Product::with('category')->latest()->take(5)->get();
                        @endphp
                        @foreach($recentProducts as $product)
                        <tr>
                            <td style="display: flex; align-items: center; gap: 1rem;">
                                @php
                                    $productImage = $product->images && is_array($product->images) && count($product->images) > 0 
                                        ? $product->images[0] 
                                        : null;
                                @endphp
                                
                                @if($productImage)
                                    <img src="{{ Storage::url(is_array($productImage) ? ($productImage['path'] ?? $productImage) : $productImage) }}" 
                                         alt="{{ $product->name }}" 
                                         style="width: 40px; height: 40px; border-radius: 6px; object-fit: cover;">
                                @else
                                    <div style="width: 40px; height: 40px; border-radius: 6px; background: rgba(212, 175, 55, 0.2); display: flex; align-items: center; justify-content: center; color: var(--admin-gold);">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                        </svg>
                                    </div>
                                @endif
                                <strong style="color: var(--text-primary);">{{ $product->name }}</strong>
                            </td>
                            <td style="color: var(--admin-gold); font-weight: 600;">
                                {{ number_format($product->price, 0, ',', ' ') }} FCFA
                            </td>
                            <td style="color: var(--text-secondary);">
                                {{ $product->category->name ?? 'Non catégorisé' }}
                            </td>
                            <td>
                                @if($product->is_active)
                                    <span class="badge badge-success">Actif</span>
                                @else
                                    <span class="badge badge-secondary">Inactif</span>
                                @endif
                                @if($product->featured)
                                    <span class="badge badge-warning" style="margin-left: 0.5rem;">Vedette</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Activité Récente -->
        <div class="admin-card">
            <h2 style="color: var(--admin-gold); margin-bottom: 1.5rem;">Activité Récente</h2>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 8px; transition: background 0.3s ease;">
                    <div style="background: rgba(37, 211, 102, 0.2); padding: 0.8rem; border-radius: 8px; color: #25D366;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div>
                        <p style="color: var(--text-primary); margin: 0; font-weight: 500;">Site mis à jour</p>
                        <small style="color: var(--text-secondary);">Il y a 2 heures</small>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 8px; transition: background 0.3s ease;">
                    <div style="background: rgba(255, 193, 7, 0.2); padding: 0.8rem; border-radius: 8px; color: #FFC107;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                        </svg>
                    </div>
                    <div>
                        <p style="color: var(--text-primary); margin: 0; font-weight: 500;">Nouveau produit ajouté</p>
                        <small style="color: var(--text-secondary);">Il y a 1 jour</small>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 8px; transition: background 0.3s ease;">
                    <div style="background: rgba(255, 192, 203, 0.2); padding: 0.8rem; border-radius: 8px; color: #FFC0CB;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                        </svg>
                    </div>
                    <div>
                        <p style="color: var(--text-primary); margin: 0; font-weight: 500;">Design amélioré</p>
                        <small style="color: var(--text-secondary);">Il y a 3 jours</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Configuration Rapide -->
    <div class="admin-card">
        <h2 style="color: var(--admin-gold); margin-bottom: 1.5rem;">Configuration Rapide</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
            <a href="{{ route('admin.header.edit') }}" class="btn-outline-admin" style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">🎨</div>
                Modifier le Header
            </a>
            <a href="{{ route('admin.footer.edit') }}" class="btn-outline-admin" style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">🦶</div>
                Modifier le Footer
            </a>
            <a href="{{ route('admin.site-settings.edit') }}" class="btn-outline-admin" style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">⚙️</div>
                Réglages du Site
            </a>
        </div>
    </div>
@endsection

<style>
.table-responsive {
    overflow-x: auto;
}

.admin-table {
    min-width: 600px;
}

@media (max-width: 1024px) {
    .admin-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .admin-table {
        min-width: 500px;
    }
}
</style>