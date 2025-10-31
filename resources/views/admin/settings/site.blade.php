@extends('admin.layout')

@section('title', 'Paramètres du Site')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Paramètres du Site</h1>
        <p style="color: var(--text-secondary); margin-top: 0.5rem;">
            Configurez les paramètres généraux de votre site ADJ ARTS
        </p>
    </div>
</div>

<div class="admin-card">
    <form action="{{ route('admin.site-settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; gap: 2rem;">
            <!-- Informations de base -->
            <div>
                <h3 style="color: var(--gold); margin-bottom: 1rem; border-bottom: 1px solid #333; padding-bottom: 0.5rem;">
                    Informations de base
                </h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label for="site_name" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Nom du site *
                        </label>
                        <input type="text" 
                               id="site_name" 
                               name="site_name" 
                               value="{{ old('site_name', $settings['site_name'] ?? 'ADJ ARTS') }}"
                               required
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                        @error('site_name')
                            <span style="color: #ff6b6b; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="site_email" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Email de contact *
                        </label>
                        <input type="email" 
                               id="site_email" 
                               name="site_email" 
                               value="{{ old('site_email', $settings['site_email'] ?? 'contact@adj-arts.com') }}"
                               required
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                        @error('site_email')
                            <span style="color: #ff6b6b; font-size: 0.875rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Informations de contact -->
            <div>
                <h3 style="color: var(--gold); margin-bottom: 1rem; border-bottom: 1px solid #333; padding-bottom: 0.5rem;">
                    Informations de contact
                </h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label for="phone" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Téléphone
                        </label>
                        <input type="text" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone', $settings['phone'] ?? '') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="address" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Adresse
                        </label>
                        <input type="text" 
                               id="address" 
                               name="address" 
                               value="{{ old('address', $settings['address'] ?? '') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>
                </div>
            </div>

            <!-- Réseaux sociaux -->
            <div>
                <h3 style="color: var(--gold); margin-bottom: 1rem; border-bottom: 1px solid #333; padding-bottom: 0.5rem;">
                    Réseaux sociaux
                </h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label for="facebook" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Facebook
                        </label>
                        <input type="url" 
                               id="facebook" 
                               name="facebook" 
                               value="{{ old('facebook', $settings['facebook'] ?? '') }}"
                               placeholder="https://facebook.com/votre-page"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="instagram" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Instagram
                        </label>
                        <input type="url" 
                               id="instagram" 
                               name="instagram" 
                               value="{{ old('instagram', $settings['instagram'] ?? '') }}"
                               placeholder="https://instagram.com/votre-compte"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="twitter" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Twitter
                        </label>
                        <input type="url" 
                               id="twitter" 
                               name="twitter" 
                               value="{{ old('twitter', $settings['twitter'] ?? '') }}"
                               placeholder="https://twitter.com/votre-compte"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="youtube" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            YouTube
                        </label>
                        <input type="url" 
                               id="youtube" 
                               name="youtube" 
                               value="{{ old('youtube', $settings['youtube'] ?? '') }}"
                               placeholder="https://youtube.com/votre-chaine"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>
                </div>
            </div>

            <!-- Paramètres SEO -->
            <div>
                <h3 style="color: var(--gold); margin-bottom: 1rem; border-bottom: 1px solid #333; padding-bottom: 0.5rem;">
                    Paramètres SEO
                </h3>
                
                <div class="form-group">
                    <label for="meta_description" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                        Description meta
                    </label>
                    <textarea id="meta_description" 
                              name="meta_description" 
                              rows="3"
                              style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white; resize: vertical;">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                    <small style="color: var(--text-secondary); font-size: 0.875rem;">
                        Description courte pour les moteurs de recherche (max 160 caractères)
                    </small>
                </div>

                <div class="form-group">
                    <label for="keywords" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                        Mots-clés
                    </label>
                    <input type="text" 
                           id="keywords" 
                           name="keywords" 
                           value="{{ old('keywords', $settings['keywords'] ?? '') }}"
                           placeholder="bijoux, art, création, luxe"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    <small style="color: var(--text-secondary); font-size: 0.875rem;">
                        Mots-clés séparés par des virgules
                    </small>
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