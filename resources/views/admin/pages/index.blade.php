@extends('admin.layout')

@section('title', 'Gestion des Pages')

@section('content')
    <!-- Header -->
    <div class="header">
        <h1>📄 Gestion des Pages</h1>
        <a href="{{ route('admin.pages.create') }}" class="btn-admin">
            ➕ Nouvelle Page
        </a>
    </div>

    <!-- Tableau des Pages -->
    <div class="admin-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                <tr>
                    <td>
                        <strong class="text-cream">{{ $page->title }}</strong>
                    </td>
                    <td>
                        <code class="text-gold">{{ $page->slug }}</code>
                    </td>
                    <td>
                        <small class="text-cream" style="opacity: 0.7;">
                            {{ Str::limit($page->meta_description, 80) }}
                        </small>
                    </td>
                    <td>
                        @if($page->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="/{{ $page->slug }}" target="_blank" class="btn-outline-admin" style="padding: 0.4rem 0.8rem;">
                                👁️
                            </a>
                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn-outline-admin" style="padding: 0.4rem 0.8rem;">
                                ✏️
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline-admin" style="padding: 0.4rem 0.8rem; background: rgba(255,107,107,0.1); border-color: #ff6b6b; color: #ff6b6b;" 
                                        onclick="return confirm('Supprimer cette page?')">
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