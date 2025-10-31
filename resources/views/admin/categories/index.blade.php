@extends('admin.layout')

@section('title', 'Gestion des Catégories')

@section('content')
    <!-- Header -->
    <div class="header">
        <h1>📂 Gestion des Catégories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn-admin">
            ➕ Nouvelle Catégorie
        </a>
    </div>

    <!-- Tableau des Catégories -->
    <div class="admin-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Produits</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>
                        <strong class="text-cream">{{ $category->name }}</strong>
                        @if($category->description)
                        <br>
                        <small class="text-cream" style="opacity: 0.7;">{{ $category->description }}</small>
                        @endif
                    </td>
                    <td>
                        <code class="text-gold">{{ $category->slug }}</code>
                    </td>
                    <td>
                        <span class="badge badge-info">{{ $category->products_count }} produits</span>
                    </td>
                    <td>
                        @if($category->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn-outline-admin" style="padding: 0.4rem 0.8rem;">
                                ✏️
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline-admin" style="padding: 0.4rem 0.8rem; background: rgba(255,107,107,0.1); border-color: #ff6b6b; color: #ff6b6b;" 
                                        onclick="return confirm('Supprimer cette catégorie?')">
                                    🗑️
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