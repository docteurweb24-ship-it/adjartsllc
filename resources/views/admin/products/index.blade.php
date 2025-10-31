@extends('admin.layout')

@section('title', 'Gestion des Produits')

@section('content')
    <!-- Header -->
    <div class="header">
        <h1>Gestion des Produits</h1>
        <a href="{{ route('admin.products.create') }}" class="btn-admin">
            Nouveau Produit
        </a>
    </div>

    <!-- Statistiques Produits -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $products->count() }}</div>
            <div class="stat-label">Total Produits</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $products->where('featured', true)->count() }}</div>
            <div class="stat-label">Vedettes</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $products->where('stock', '>', 0)->count() }}</div>
            <div class="stat-label">En Stock</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $products->where('stock', 0)->count() }}</div>
            <div class="stat-label">Rupture</div>
        </div>
    </div>

    <!-- Tableau des Produits -->
    <div class="admin-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Stock</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        @if($product->main_image)
                        <img src="{{ asset('storage/images/products/' . $product->main_image) }}" 
                             alt="{{ $product->name }}"
                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border-color);">
                        @else
                        <div style="width: 50px; height: 50px; background: var(--bg-secondary); border-radius: 6px; display: flex; align-items: center; justify-content: center; color: var(--text-secondary); font-size: 0.8rem;">
                            Pas d'image
                        </div>
                        @endif
                    </td>
                    <td>
                        <strong class="text-cream">{{ $product->name }}</strong>
                        <br>
                        <small class="text-cream" style="opacity: 0.7;">{{ $product->material }}</small>
                    </td>
                    <td class="text-gold">
                        <strong>{{ number_format($product->price, 0, ',', ' ') }} FCFA</strong>
                    </td>
                    <td>
                        <span class="badge badge-info">{{ $product->category->name }}</span>
                    </td>
                    <td>
                        @if($product->stock > 0)
                            <span class="badge badge-success">{{ $product->stock }} unités</span>
                        @else
                            <span class="badge badge-secondary">Rupture</span>
                        @endif
                    </td>
                    <td>
                        @if($product->is_active)
                            <span class="badge badge-success">Actif</span>
                        @else
                            <span class="badge badge-secondary">Inactif</span>
                        @endif
                        @if($product->featured)
                            <span class="badge badge-warning" style="margin-left: 0.3rem;">Vedette</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn-outline-admin" style="padding: 0.4rem 0.8rem;">
                                Modifier
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline-admin" style="padding: 0.4rem 0.8rem; background: rgba(255,107,107,0.1); border-color: #ff6b6b; color: #ff6b6b;" 
                                        onclick="return confirm('Supprimer ce produit?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection