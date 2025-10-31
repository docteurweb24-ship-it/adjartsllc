@extends('admin.layout')

@section('title', 'Personnalisation du Footer')

@section('content')
<div class="admin-page-header">
    <div>
        <h1>Personnalisation du Footer</h1>
        <p style="color: var(--text-secondary); margin-top: 0.5rem;">
            Personnalisez le pied de page de votre site ADJ ARTS
        </p>
    </div>
</div>

<div class="admin-card">
    <form action="{{ route('admin.footer.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; gap: 2rem;">
            <!-- Informations du footer -->
            <div>
                <h3 style="color: var(--gold); margin-bottom: 1rem; border-bottom: 1px solid #333; padding-bottom: 0.5rem;">
                    Informations du footer
                </h3>
                
                <div class="form-group">
                    <label for="footer_description" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                        Description du footer
                    </label>
                    <textarea id="footer_description" 
                              name="footer_description" 
                              rows="3"
                              placeholder="Une brève description de votre entreprise pour le footer..."
                              style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white; resize: vertical;">{{ old('footer_description', $footerSettings['description'] ?? 'ADJ ARTS - Créations artistiques uniques et bijoux de luxe') }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label for="footer_phone" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Téléphone footer
                        </label>
                        <input type="text" 
                               id="footer_phone" 
                               name="footer_phone" 
                               value="{{ old('footer_phone', $footerSettings['phone'] ?? '') }}"
                               placeholder="+33 1 23 45 67 89"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="footer_email" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Email footer
                        </label>
                        <input type="email" 
                               id="footer_email" 
                               name="footer_email" 
                               value="{{ old('footer_email', $footerSettings['email'] ?? 'contact@adj-arts.com') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="footer_address" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                        Adresse footer
                    </label>
                    <textarea id="footer_address" 
                              name="footer_address" 
                              rows="2"
                              placeholder="Votre adresse complète..."
                              style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white; resize: vertical;">{{ old('footer_address', $footerSettings['address'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- Liens rapides -->
            <div>
                <h3 style="color: var(--gold); margin-bottom: 1rem; border-bottom: 1px solid #333; padding-bottom: 0.5rem;">
                    Liens rapides
                </h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label for="link1_text" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Lien 1 - Texte
                        </label>
                        <input type="text" 
                               id="link1_text" 
                               name="link1_text" 
                               value="{{ old('link1_text', $footerSettings['link1_text'] ?? 'Nos collections') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="link1_url" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Lien 1 - URL
                        </label>
                        <input type="text" 
                               id="link1_url" 
                               name="link1_url" 
                               value="{{ old('link1_url', $footerSettings['link1_url'] ?? '/collections') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="link2_text" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Lien 2 - Texte
                        </label>
                        <input type="text" 
                               id="link2_text" 
                               name="link2_text" 
                               value="{{ old('link2_text', $footerSettings['link2_text'] ?? 'Notre histoire') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="link2_url" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Lien 2 - URL
                        </label>
                        <input type="text" 
                               id="link2_url" 
                               name="link2_url" 
                               value="{{ old('link2_url', $footerSettings['link2_url'] ?? '/a-propos') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>
                </div>
            </div>

            <!-- Copyright et mentions légales -->
            <div>
                <h3 style="color: var(--gold); margin-bottom: 1rem; border-bottom: 1px solid #333; padding-bottom: 0.5rem;">
                    Copyright et mentions légales
                </h3>
                
                <div class="form-group">
                    <label for="copyright_text" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                        Texte de copyright
                    </label>
                    <input type="text" 
                           id="copyright_text" 
                           name="copyright_text" 
                           value="{{ old('copyright_text', $footerSettings['copyright_text'] ?? '© 2024 ADJ ARTS. Tous droits réservés.') }}"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label for="privacy_url" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            URL Politique de confidentialité
                        </label>
                        <input type="text" 
                               id="privacy_url" 
                               name="privacy_url" 
                               value="{{ old('privacy_url', $footerSettings['privacy_url'] ?? '/privacy') }}"
                               style="width: 100%; padding: 0.75rem; border: 1px solid #333; border-radius: 5px; background: #0a0a0a; color: white;">
                    </div>

                    <div class="form-group">
                        <label for="terms_url" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            URL Conditions d'utilisation
                        </label>
                        <input type="text" 
                               id="terms_url" 
                               name="terms_url" 
                               value="{{ old('terms_url', $footerSettings['terms_url'] ?? '/terms') }}"
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