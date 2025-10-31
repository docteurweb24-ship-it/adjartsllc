@extends('admin.layout')

@section('title', 'Modifier la Catégorie')

@section('content')
    <!-- Header -->
    <div class="header">
        <h1>✏️ Modifier la Catégorie</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn-outline-admin">
            ← Retour
        </a>
    </div>

    <!-- Formulaire -->
    <div class="admin-card">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="max-width: 600px; margin: 0 auto;">
                <div style="margin-bottom: 2rem;">
                    <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Nom de la catégorie *</label>
                    <input type="text" name="name" value="{{ $category->name }}" required 
                           style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(212,175,55,0.3); border-radius: 6px; color: var(--cream);">
                </div>

                <div style="margin-bottom: 2rem;">
                    <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Description</label>
                    <textarea name="description" rows="4"
                              style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(212,175,55,0.3); border-radius: 6px; color: var(--cream); resize: vertical;">{{ $category->description }}</textarea>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--cream);">
                        <input type="checkbox" name="is_active" {{ $category->is_active ? 'checked' : '' }} style="transform: scale(1.2);">
                        ✅ Catégorie active
                    </label>
                </div>

                <!-- Actions -->
                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn-admin" style="flex: 1;">
                        💾 Modifier la catégorie
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn-outline-admin" style="flex: 1; text-align: center;">
                        ❌ Annuler
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection