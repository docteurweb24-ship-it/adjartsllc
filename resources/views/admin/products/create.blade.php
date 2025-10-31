@extends('admin.layout')

@section('title', 'Nouveau Produit')

@section('content')
    <!-- Header -->
    <div class="header">
        <h1>Nouveau Produit</h1>
        <a href="{{ route('admin.products.index') }}" class="btn-outline-admin">
            Retour
        </a>
    </div>

    <!-- Formulaire -->
    <div class="admin-card">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <!-- Colonne Gauche -->
                <div>
                    <h3 class="text-gold" style="margin-bottom: 1.5rem;">Informations de base</h3>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                            Nom du produit *
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required 
                               style="width: 100%; padding: 0.8rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 6px; color: var(--text-primary);">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                            Description *
                        </label>
                        <textarea name="description" rows="4" required 
                                  style="width: 100%; padding: 0.8rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 6px; color: var(--text-primary); resize: vertical;">{{ old('description') }}</textarea>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                            Catégorie *
                        </label>
                        <select name="category_id" required 
                                style="width: 100%; padding: 0.8rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 6px; color: var(--text-primary);">
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Colonne Droite -->
                <div>
                    <h3 class="text-gold" style="margin-bottom: 1.5rem;">Prix & Stock</h3>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                            Prix (FCFA) *
                        </label>
                        <input type="number" name="price" value="{{ old('price') }}" step="0.01" required 
                               style="width: 100%; padding: 0.8rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 6px; color: var(--text-primary);">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                            Matériau
                        </label>
                        <input type="text" name="material" value="{{ old('material') }}"
                               style="width: 100%; padding: 0.8rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 6px; color: var(--text-primary);">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                            Dimensions
                        </label>
                        <input type="text" name="dimensions" value="{{ old('dimensions') }}" placeholder="ex: 25x15x10 cm"
                               style="width: 100%; padding: 0.8rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 6px; color: var(--text-primary);">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                            Stock *
                        </label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}"
                               style="width: 100%; padding: 0.8rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 6px; color: var(--text-primary);">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                            Lien Amazon
                        </label>
                        <input type="url" name="amazon_link" value="{{ old('amazon_link') }}"
                               style="width: 100%; padding: 0.8rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 6px; color: var(--text-primary);">
                    </div>
                </div>
            </div>

            <!-- Section Images -->
            <div style="margin: 2rem 0; padding: 2rem 0; border-top: 1px solid var(--border-color);">
                <h3 class="text-gold" style="margin-bottom: 1.5rem;">Images du produit</h3>
                
                <div style="margin-bottom: 1.5rem;">
                    <label class="text-cream" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                        Images (max 5, jpg, png, gif, webp - 2MB max par image)
                    </label>
                    <input type="file" name="images[]" multiple accept="image/*"
                           style="width: 100%; padding: 0.8rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 6px; color: var(--text-primary);">
                    <small class="text-cream" style="opacity: 0.7;">
                        La première image sera utilisée comme image principale
                    </small>
                </div>

                <!-- Aperçu des images (vide pour create) -->
                <div id="image-preview" style="display: none;">
                    <h4 class="text-pink" style="margin-bottom: 1rem;">Aperçu des images</h4>
                    <div id="preview-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem;"></div>
                </div>
            </div>

            <!-- Options -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border-color);">
                <div>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-primary);">
                        <input type="checkbox" name="featured" {{ old('featured') ? 'checked' : '' }} style="transform: scale(1.2);">
                        Produit vedette
                    </label>
                </div>
                <div>
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-primary);">
                        <input type="checkbox" name="is_active" {{ old('is_active', true) ? 'checked' : '' }} style="transform: scale(1.2);">
                        Produit actif
                    </label>
                </div>
            </div>

            <!-- Actions -->
            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn-admin" style="flex: 1;">
                    Créer le produit
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn-outline-admin" style="flex: 1; text-align: center;">
                    Annuler
                </a>
            </div>
        </form>
    </div>

    <script>
        // Aperçu des images avant upload
        document.querySelector('input[name="images[]"]').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');
            previewContainer.innerHTML = '';
            
            if (this.files.length > 0) {
                imagePreview.style.display = 'block';
                
                Array.from(this.files).forEach((file, index) => {
                    if (index >= 5) return; // Limite à 5 images
                    
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.style.position = 'relative';
                        div.innerHTML = `
                            <img src="${e.target.result}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color);">
                            <div style="position: absolute; top: 5px; right: 5px; background: rgba(0,0,0,0.7); color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 12px;">
                                ${index + 1}
                            </div>
                        `;
                        previewContainer.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                imagePreview.style.display = 'none';
            }
        });
    </script>
@endsection