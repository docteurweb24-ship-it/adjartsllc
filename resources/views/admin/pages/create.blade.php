@extends('admin.layout')

@section('title', 'Nouvelle Page')

@section('content')
    <!-- Header -->
    <div class="header">
        <h1>📄 Nouvelle Page</h1>
        <a href="{{ route('admin.pages.index') }}" class="btn-outline-admin">
            ← Retour
        </a>
    </div>

    <!-- Formulaire -->
    <div class="admin-card">
        <form action="{{ route('admin.pages.store') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 2rem;">
                <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Titre *</label>
                <input type="text" name="title" required 
                       style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(212,175,55,0.3); border-radius: 6px; color: var(--cream);">
            </div>

            <div style="margin-bottom: 2rem;">
                <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Contenu *</label>
                <textarea name="content" rows="12" required 
                          style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(212,175,55,0.3); border-radius: 6px; color: var(--cream); resize: vertical;"></textarea>
                <small class="text-cream" style="opacity: 0.7;">HTML autorisé</small>
            </div>

            <div style="margin-bottom: 2rem;">
                <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Description meta (SEO)</label>
                <textarea name="meta_description" rows="3" 
                          style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(212,175,55,0.3); border-radius: 6px; color: var(--cream); resize: vertical;"></textarea>
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--cream);">
                    <input type="checkbox" name="is_active" checked style="transform: scale(1.2);">
                    ✅ Page active
                </label>
            </div>

            <!-- Actions -->
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn-admin" style="flex: 1;">
                    💾 Créer la page
                </button>
                <a href="{{ route('admin.pages.index') }}" class="btn-outline-admin" style="flex: 1; text-align: center;">
                    ❌ Annuler
                </a>
            </div>
        </form>
    </div>
@endsection