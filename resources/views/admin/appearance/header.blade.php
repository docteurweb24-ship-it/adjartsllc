@extends('admin.layout')

@section('title', 'Personnalisation du Header')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Personnalisation du Header</h1>
        <p style="color: var(--text-secondary); margin-top: 0.5rem;">
            Personnalisez l'en-tête de votre site ADJ ARTS
        </p>
    </div>
</div>

<div class="admin-card">
    <form action="{{ route('admin.header.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; gap: 2rem;">
            <!-- Logo -->
            <div>
                <h3 style="color: var(--gold); margin-bottom: 1rem; border-bottom: 1px solid #333; padding-bottom: 0.5rem;">
                    Logo
                </h3>
                
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                        Logo actuel
                    </label>
                    <div style="background: #0a0a0a; padding: 2rem; border: 1px solid #333; border-radius: 5px; text-align: center;">
                        @if($headerSettings['logo_url'] ?? false)
                            <img src="{{ $headerSettings['logo_url'] }}" alt="Logo actuel" style="max-height: 80px; max-width: 200px;">
                            <p style="margin-top: 1rem; color: var(--text-secondary);">Logo actuel</p>
                        @else
                            <p style="color: var(--text-secondary);">Aucun logo uploadé</p>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="logo_upload" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                        Uploader un nouveau logo
                    </label>
                    <input type="file" 
                           id="logo_upload" 
                           name="logo"
                           accept="image/*"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    <small style="color: var(--text-secondary); font-size: 0.875rem;">
                        Formats acceptés: JPG, PNG, SVG. Taille max: 2MB
                    </small>
                </div>
            </div>

            <!-- Navigation -->
            <div>
                <h3 style="color: var(--gold); margin-bottom: 1rem; border-bottom: 1px solid #333; padding-bottom: 0.5rem;">
                    Navigation
                </h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label for="nav_item1_text" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Élément 1 - Texte
                        </label>
                        <input type="text" 
                               id="nav_item1_text" 
                               name="nav_item1_text" 
                               value="{{ old('nav_item1_text', $headerSettings['nav_item1_text'] ?? 'Collections') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="nav_item1_url" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Élément 1 - URL
                        </label>
                        <input type="text" 
                               id="nav_item1_url" 
                               name="nav_item1_url" 
                               value="{{ old('nav_item1_url', $headerSettings['nav_item1_url'] ?? '/collections') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="nav_item2_text" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Élément 2 - Texte
                        </label>
                        <input type="text" 
                               id="nav_item2_text" 
                               name="nav_item2_text" 
                               value="{{ old('nav_item2_text', $headerSettings['nav_item2_text'] ?? 'À propos') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="nav_item2_url" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Élément 2 - URL
                        </label>
                        <input type="text" 
                               id="nav_item2_url" 
                               name="nav_item2_url" 
                               value="{{ old('nav_item2_url', $headerSettings['nav_item2_url'] ?? '/a-propos') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="nav_item3_text" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Élément 3 - Texte
                        </label>
                        <input type="text" 
                               id="nav_item3_text" 
                               name="nav_item3_text" 
                               value="{{ old('nav_item3_text', $headerSettings['nav_item3_text'] ?? 'Blog') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="nav_item3_url" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Élément 3 - URL
                        </label>
                        <input type="text" 
                               id="nav_item3_url" 
                               name="nav_item3_url" 
                               value="{{ old('nav_item3_url', $headerSettings['nav_item3_url'] ?? '/blog') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>
                </div>
            </div>

            <!-- Bouton CTA -->
            <div>
                <h3 style="color: var(--gold); margin-bottom: 1rem; border-bottom: 1px solid #333; padding-bottom: 0.5rem;">
                    Bouton d'appel à l'action
                </h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label for="cta_text" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Texte du bouton
                        </label>
                        <input type="text" 
                               id="cta_text" 
                               name="cta_text" 
                               value="{{ old('cta_text', $headerSettings['cta_text'] ?? 'Contactez-nous') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="cta_url" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            URL du bouton
                        </label>
                        <input type="text" 
                               id="cta_url" 
                               name="cta_url" 
                               value="{{ old('cta_url', $headerSettings['cta_url'] ?? '/contact') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Boutons d'action -->
        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #333;">
            <a href="{{ route('admin.dashboard') }}" 
               style="padding: 0.75rem 1.5rem; border: 1px solid #333; border-radius: 5px; color: white; text-decoration: none; transition: all 0.3s ease;">
                Annuler
            </a>
            <button type="submit" 
                    style="background: var(--gold); color: var(--dark-bg); padding: 0.75rem 1.5rem; border: none; border-radius: 5px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

<style>
.form-group {
    margin-bottom: 1.5rem;
}

input:focus, textarea:focus {
    outline: none;
    border-color: var(--gold) !important;
    box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
}

button:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
}

a:hover {
    border-color: var(--gold) !important;
}
</style>
@endsection