@extends('admin.layout')

@section('title', 'Nouvel Article')

@section('content')
    <div class="admin-page-header">
        <div>
            <h1>Nouvel Article</h1>
            <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                Créez un nouvel article pour votre blog ADJ ARTS
            </p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.blog-posts.index') }}" class="btn-outline-admin">
                ← Retour aux articles
            </a>
        </div>
    </div>

    @if($errors->any())
        <div style="background: rgba(255, 107, 107, 0.1); border: 1px solid var(--admin-danger); border-radius: 8px; padding: 1rem; margin-bottom: 2rem;">
            <h4 style="color: var(--admin-danger); margin-bottom: 0.5rem;">Erreurs de validation :</h4>
            <ul style="color: var(--admin-danger); list-style: none; padding: 0;">
                @foreach($errors->all() as $error)
                    <li style="padding: 0.25rem 0;">• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="admin-card">
        <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf

            <div class="form-layout">
                <!-- Colonne principale -->
                <div class="form-main-column">
                    <!-- Titre -->
                    <div class="form-group">
                        <label for="title" class="form-label">
                            Titre de l'article *
                            <span class="required-indicator">*</span>
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               required
                               class="form-control"
                               placeholder="Titre attractif pour votre article">
                    </div>

                    <!-- Slug (généré automatiquement) -->
                    <div class="form-group">
                        <label for="slug" class="form-label">Slug (URL)</label>
                        <input type="text" 
                               id="slug" 
                               name="slug" 
                               value="{{ old('slug') }}"
                               class="form-control"
                               placeholder="url-automatique-de-l-article">
                        <div class="form-hint">
                            Laisser vide pour générer automatiquement à partir du titre
                        </div>
                    </div>

                    <!-- Extrait -->
                    <div class="form-group">
                        <label for="excerpt" class="form-label">Extrait</label>
                        <textarea id="excerpt" 
                                  name="excerpt" 
                                  rows="3"
                                  class="form-control"
                                  placeholder="Courte description qui apparaîtra dans les listes d'articles">{{ old('excerpt') }}</textarea>
                        <div class="char-counter" data-target="excerpt" data-max="500">
                            <span class="char-count">0</span>/500 caractères
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="form-group">
                        <label for="content" class="form-label">
                            Contenu de l'article *
                            <span class="required-indicator">*</span>
                        </label>
                        
                        <!-- Barre d'outils éditeur -->
                        <div class="editor-toolbar">
                            <div class="toolbar-group">
                                <button type="button" class="toolbar-btn" data-format="bold" title="Gras">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M15.6 10.79c.97-.67 1.65-1.77 1.65-2.79 0-2.26-1.75-4-4-4H7v14h7.04c2.09 0 3.71-1.7 3.71-3.79 0-1.52-.86-2.82-2.15-3.42zM10 6.5h3c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-3v-3zm3.5 9H10v-3h3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5z"/>
                                    </svg>
                                </button>
                                <button type="button" class="toolbar-btn" data-format="italic" title="Italique">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M10 4v3h2.21l-3.42 8H6v3h8v-3h-2.21l3.42-8H18V4z"/>
                                    </svg>
                                </button>
                                <button type="button" class="toolbar-btn" data-format="underline" title="Souligné">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 17c3.31 0 6-2.69 6-6V3h-2.5v8c0 1.93-1.57 3.5-3.5 3.5S8.5 12.93 8.5 11V3H6v8c0 3.31 2.69 6 6 6zm-7 2v2h14v-2H5z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="toolbar-group">
                                <button type="button" class="toolbar-btn" data-format="ul" title="Liste à puces">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M4 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm0-6c-.83 0-1.5.67-1.5 1.5S3.17 7.5 4 7.5 5.5 6.83 5.5 6 4.83 4.5 4 4.5zm0 12c-.83 0-1.5.68-1.5 1.5s.68 1.5 1.5 1.5 1.5-.68 1.5-1.5-.67-1.5-1.5-1.5zM7 19h14v-2H7v2zm0-6h14v-2H7v2zm0-8v2h14V5H7z"/>
                                    </svg>
                                </button>
                                <button type="button" class="toolbar-btn" data-format="ol" title="Liste numérotée">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M2 17h2v.5H3v1h1v.5H2v1h3v-4H2v1zm1-9h1V4H2v1h1v3zm-1 3h1.8L2 13.1v.9h3v-1H3.2L5 10.9V10H2v1zm5-6v2h14V5H7zm0 14h14v-2H7v2zm0-6h14v-2H7v2z"/>
                                    </svg>
                                </button>
                                <button type="button" class="toolbar-btn" data-format="blockquote" title="Citation">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <textarea id="content" 
                                  name="content" 
                                  rows="15"
                                  required
                                  class="editor-content"
                                  placeholder="Contenu détaillé de votre article...">{{ old('content') }}</textarea>
                        <div class="char-counter" data-target="content">
                            <span class="char-count">0</span> caractères
                        </div>
                    </div>
                </div>

                <!-- Colonne latérale -->
                <div class="form-sidebar">
                    <!-- Image mise en avant -->
                    <div class="form-group">
                        <label class="form-label">Image mise en avant</label>
                        <div class="image-upload-area" id="imageUploadArea">
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor" style="opacity: 0.7;">
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                </svg>
                                <p>Glissez-déposez une image ou cliquez pour parcourir</p>
                                <span class="upload-hint">PNG, JPG, JPEG - Max 2MB</span>
                            </div>
                            <div class="image-preview" id="imagePreview" style="display: none;">
                                <img id="previewImage" src="" alt="Aperçu">
                                <button type="button" class="remove-image" id="removeImage">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                    </svg>
                                </button>
                            </div>
                            <input type="file" 
                                   id="featured_image" 
                                   name="featured_image" 
                                   accept="image/*"
                                   style="display: none;">
                        </div>
                    </div>

                    <!-- Statut de publication -->
                    <div class="form-group">
                        <label class="form-label">Statut de publication</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" 
                                       name="is_published" 
                                       value="1" 
                                       {{ old('is_published', 1) ? 'checked' : '' }}>
                                <span class="radio-checkmark"></span>
                                <div class="radio-content">
                                    <span class="radio-label">Publié</span>
                                    <span class="radio-description">Visible par tous</span>
                                </div>
                            </label>
                            <label class="radio-option">
                                <input type="radio" 
                                       name="is_published" 
                                       value="0" 
                                       {{ !old('is_published', 1) ? 'checked' : '' }}>
                                <span class="radio-checkmark"></span>
                                <div class="radio-content">
                                    <span class="radio-label">Brouillon</span>
                                    <span class="radio-description">Visible en admin seulement</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- SEO -->
                    <div class="form-section">
                        <h4 class="form-section-title">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 0.5rem;">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                            </svg>
                            Optimisation SEO
                        </h4>
                        
                        <div class="form-group">
                            <label for="meta_title" class="form-label">Titre SEO</label>
                            <input type="text" 
                                   id="meta_title" 
                                   name="meta_title" 
                                   value="{{ old('meta_title') }}"
                                   class="form-control"
                                   placeholder="Titre pour les moteurs de recherche">
                            <div class="char-counter" data-target="meta_title" data-max="60">
                                <span class="char-count">0</span>/60 caractères
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="meta_description" class="form-label">Description SEO</label>
                            <textarea id="meta_description" 
                                      name="meta_description" 
                                      rows="3"
                                      class="form-control"
                                      placeholder="Description pour les moteurs de recherche">{{ old('meta_description') }}</textarea>
                            <div class="char-counter" data-target="meta_description" data-max="160">
                                <span class="char-count">0</span>/160 caractères
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="form-actions">
                <a href="{{ route('admin.blog-posts.index') }}" class="btn-cancel">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 0.5rem;">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                    Annuler
                </a>
                <div style="display: flex; gap: 1rem;">
                    <button type="submit" name="draft" value="1" class="btn-draft">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 0.5rem;">
                            <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/>
                        </svg>
                        Sauvegarder brouillon
                    </button>
                    <button type="submit" name="publish" value="1" class="btn-publish">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 0.5rem;">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                        Publier l'article
                    </button>
                </div>
            </div>
        </form>
    </div>

    <style>
    .form-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        align-items: start;
    }

    .form-main-column {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        position: sticky;
        top: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--text-primary);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background: var(--bg-card);
        color: var(--text-primary);
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--admin-gold);
        box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
        background: var(--bg-secondary);
    }

    .form-control::placeholder {
        color: var(--text-secondary);
        opacity: 0.6;
    }

    .required-indicator {
        color: var(--admin-danger);
        margin-left: 0.25rem;
    }

    .form-hint {
        color: var(--text-secondary);
        font-size: 0.8rem;
        margin-top: 0.5rem;
        opacity: 0.7;
    }

    .char-counter {
        display: flex;
        justify-content: flex-end;
        color: var(--text-secondary);
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }

    .char-counter.warning {
        color: #ffa726;
    }

    .char-counter.error {
        color: var(--admin-danger);
    }

    /* Éditeur */
    .editor-toolbar {
        display: flex;
        gap: 1rem;
        padding: 0.75rem;
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-bottom: none;
        border-radius: 8px 8px 0 0;
    }

    .toolbar-group {
        display: flex;
        gap: 0.25rem;
    }

    .toolbar-btn {
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: 4px;
        color: var(--text-primary);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .toolbar-btn:hover {
        background: rgba(212, 175, 55, 0.1);
        color: var(--admin-gold);
    }

    .editor-content {
        width: 100%;
        min-height: 400px;
        padding: 1rem;
        border: 1px solid var(--border-color);
        border-radius: 0 0 8px 8px;
        background: var(--bg-card);
        color: var(--text-primary);
        font-family: inherit;
        font-size: 0.95rem;
        line-height: 1.6;
        resize: vertical;
        transition: border-color 0.3s ease;
    }

    .editor-content:focus {
        outline: none;
        border-color: var(--admin-gold);
        box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
    }

    /* Upload d'image */
    .image-upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .image-upload-area:hover {
        border-color: var(--admin-gold);
        background: rgba(212, 175, 55, 0.05);
    }

    .image-upload-area.dragover {
        border-color: var(--admin-gold);
        background: rgba(212, 175, 55, 0.1);
    }

    .upload-placeholder {
        color: var(--text-secondary);
    }

    .upload-placeholder p {
        margin: 1rem 0 0.5rem;
        font-weight: 500;
    }

    .upload-hint {
        font-size: 0.8rem;
        opacity: 0.7;
    }

    .image-preview {
        position: relative;
        border-radius: 6px;
        overflow: hidden;
    }

    .image-preview img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 6px;
    }

    .remove-image {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        background: rgba(0, 0, 0, 0.7);
        border: none;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .remove-image:hover {
        background: rgba(0, 0, 0, 0.9);
        transform: scale(1.1);
    }

    /* Radio buttons */
    .radio-group {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .radio-option {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .radio-option:hover {
        border-color: var(--admin-gold);
        background: rgba(212, 175, 55, 0.05);
    }

    .radio-option input[type="radio"] {
        display: none;
    }

    .radio-checkmark {
        width: 18px;
        height: 18px;
        border: 2px solid var(--border-color);
        border-radius: 50%;
        position: relative;
        transition: all 0.3s ease;
        flex-shrink: 0;
        margin-top: 0.1rem;
    }

    .radio-option input[type="radio"]:checked + .radio-checkmark {
        border-color: var(--admin-gold);
        background: var(--admin-gold);
    }

    .radio-option input[type="radio"]:checked + .radio-checkmark::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 6px;
        height: 6px;
        background: white;
        border-radius: 50%;
    }

    .radio-content {
        flex: 1;
    }

    .radio-label {
        display: block;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .radio-description {
        display: block;
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    /* Sections */
    .form-section {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.5rem;
    }

    .form-section-title {
        display: flex;
        align-items: center;
        color: var(--admin-gold);
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border-color);
    }

    /* Actions */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--border-color);
    }

    .btn-cancel {
        padding: 0.75rem 1.5rem;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        color: var(--text-primary);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .btn-cancel:hover {
        border-color: var(--admin-gold);
        color: var(--admin-gold);
    }

    .btn-draft {
        background: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .btn-draft:hover {
        border-color: var(--admin-gold);
        color: var(--admin-gold);
    }

    .btn-publish {
        background: var(--admin-gold);
        border: none;
        color: black;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .btn-publish:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
    }

    /* Responsive */
    @media (max-width: 968px) {
        .form-layout {
            grid-template-columns: 1fr;
        }
        
        .form-sidebar {
            position: static;
        }
        
        .form-actions {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }
        
        .form-actions > div {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
    }

    @media (max-width: 768px) {
        .editor-toolbar {
            flex-wrap: wrap;
        }
        
        .toolbar-group {
            flex-wrap: wrap;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('blogForm');
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        const contentTextarea = document.getElementById('content');
        const featuredImageInput = document.getElementById('featured_image');
        const imageUploadArea = document.getElementById('imageUploadArea');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const imagePreview = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');
        const removeImageBtn = document.getElementById('removeImage');

        // Génération automatique du slug
        titleInput.addEventListener('input', function() {
            if (!slugInput.value || slugInput.dataset.manual !== 'true') {
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
                slugInput.value = slug;
            }
        });

        slugInput.addEventListener('input', function() {
            this.dataset.manual = 'true';
        });

        // Compteurs de caractères
        function setupCharCounter(textarea, counter) {
            function updateCounter() {
                const count = textarea.value.length;
                const max = parseInt(counter.dataset.max) || 0;
                
                counter.querySelector('.char-count').textContent = count;
                
                counter.classList.remove('warning', 'error');
                if (max > 0) {
                    if (count > max * 0.9) {
                        counter.classList.add('warning');
                    }
                    if (count > max) {
                        counter.classList.add('error');
                    }
                }
            }
            
            textarea.addEventListener('input', updateCounter);
            updateCounter();
        }

        document.querySelectorAll('.char-counter').forEach(counter => {
            const target = counter.dataset.target;
            const textarea = document.getElementById(target);
            if (textarea) {
                setupCharCounter(textarea, counter);
            }
        });

        // Upload d'image avec drag & drop
        imageUploadArea.addEventListener('click', function() {
            featuredImageInput.click();
        });

        featuredImageInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        uploadPlaceholder.style.display = 'none';
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        removeImageBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            featuredImageInput.value = '';
            uploadPlaceholder.style.display = 'block';
            imagePreview.style.display = 'none';
        });

        // Drag & drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            imageUploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            imageUploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            imageUploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            imageUploadArea.classList.add('dragover');
        }

        function unhighlight() {
            imageUploadArea.classList.remove('dragover');
        }

        imageUploadArea.addEventListener('drop', function(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            featuredImageInput.files = files;
            featuredImageInput.dispatchEvent(new Event('change'));
        });

        // Éditeur de texte
        const toolbarButtons = document.querySelectorAll('.toolbar-btn');
        toolbarButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const format = this.dataset.format;
                applyFormat(format);
            });
        });

        function applyFormat(format) {
            const start = contentTextarea.selectionStart;
            const end = contentTextarea.selectionEnd;
            const selectedText = contentTextarea.value.substring(start, end);
            let newText = '';
            let newCursorPos = start;

            switch (format) {
                case 'bold':
                    newText = `**${selectedText}**`;
                    newCursorPos = start + 2;
                    break;
                case 'italic':
                    newText = `*${selectedText}*`;
                    newCursorPos = start + 1;
                    break;
                case 'underline':
                    newText = `<u>${selectedText}</u>`;
                    newCursorPos = start + 3;
                    break;
                case 'ul':
                    newText = selectedText ? `- ${selectedText}` : '- ';
                    newCursorPos = start + 2;
                    break;
                case 'ol':
                    newText = selectedText ? `1. ${selectedText}` : '1. ';
                    newCursorPos = start + 3;
                    break;
                case 'blockquote':
                    newText = selectedText ? `> ${selectedText}` : '> ';
                    newCursorPos = start + 2;
                    break;
            }

            contentTextarea.value = contentTextarea.value.substring(0, start) + 
                                   newText + 
                                   contentTextarea.value.substring(end);
            contentTextarea.focus();
            contentTextarea.setSelectionRange(newCursorPos, newCursorPos + selectedText.length);
        }

        // Validation avant envoi
        form.addEventListener('submit', function(e) {
            const title = titleInput.value.trim();
            const content = contentTextarea.value.trim();
            
            if (!title) {
                e.preventDefault();
                alert('Le titre est obligatoire');
                titleInput.focus();
                return;
            }
            
            if (!content) {
                e.preventDefault();
                alert('Le contenu est obligatoire');
                contentTextarea.focus();
                return;
            }
        });
    });
    </script>
@endsection