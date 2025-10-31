@extends('admin.layout')

@section('title', 'Créer une Promotion')

@section('content')
    <div class="header">
        <h1>🎁 Créer une Promotion</h1>
        <a href="{{ route('admin.promotions.index') }}" class="btn-outline-admin">
            ← Retour aux promotions
        </a>
    </div>

    <div class="admin-card">
        <form action="{{ route('admin.promotions.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <!-- Colonne de gauche -->
                <div>
                    <!-- Code Promotion -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="code" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Code Promotion *
                        </label>
                        <input type="text" 
                               id="code" 
                               name="code" 
                               value="{{ old('code') }}"
                               required
                               placeholder="EX: SOLDE20"
                               style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 6px; background: var(--bg-card); color: var(--text-primary);">
                        @error('code')
                            <span style="color: #ff6b6b; font-size: 0.9rem; margin-top: 0.5rem; display: block;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="description" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Description *
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3"
                                  required
                                  placeholder="Description de la promotion..."
                                  style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 6px; background: var(--bg-card); color: var(--text-primary);">{{ old('description') }}</textarea>
                        @error('description')
                            <span style="color: #ff6b6b; font-size: 0.9rem; margin-top: 0.5rem; display: block;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Type de promotion -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="type" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Type de Promotion *
                        </label>
                        <select id="type" name="type" required
                                style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 6px; background: var(--bg-card); color: var(--text-primary);">
                            <option value="">Sélectionnez un type</option>
                            <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Pourcentage (%)</option>
                            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Montant fixe</option>
                        </select>
                        @error('type')
                            <span style="color: #ff6b6b; font-size: 0.9rem; margin-top: 0.5rem; display: block;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Valeur -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="value" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Valeur *
                        </label>
                        <input type="number" 
                               id="value" 
                               name="value" 
                               value="{{ old('value') }}"
                               step="0.01"
                               min="0"
                               required
                               placeholder="20 pour 20% ou 5000 pour 5000 FCFA"
                               style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 6px; background: var(--bg-card); color: var(--text-primary);">
                        @error('value')
                            <span style="color: #ff6b6b; font-size: 0.9rem; margin-top: 0.5rem; display: block;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Colonne de droite -->
                <div>
                    <!-- Montant minimum -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="min_amount" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Montant Minimum (FCFA)
                        </label>
                        <input type="number" 
                               id="min_amount" 
                               name="min_amount" 
                               value="{{ old('min_amount') }}"
                               step="0.01"
                               min="0"
                               placeholder="Optionnel"
                               style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 6px; background: var(--bg-card); color: var(--text-primary);">
                        @error('min_amount')
                            <span style="color: #ff6b6b; font-size: 0.9rem; margin-top: 0.5rem; display: block;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Limite d'utilisation -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="usage_limit" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Limite d'Utilisation
                        </label>
                        <input type="number" 
                               id="usage_limit" 
                               name="usage_limit" 
                               value="{{ old('usage_limit') }}"
                               min="1"
                               placeholder="Optionnel - nombre maximum d'utilisations"
                               style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 6px; background: var(--bg-card); color: var(--text-primary);">
                        @error('usage_limit')
                            <span style="color: #ff6b6b; font-size: 0.9rem; margin-top: 0.5rem; display: block;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Date de début -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="starts_at" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Date de Début *
                        </label>
                        <input type="datetime-local" 
                               id="starts_at" 
                               name="starts_at" 
                               value="{{ old('starts_at') }}"
                               required
                               style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 6px; background: var(--bg-card); color: var(--text-primary);">
                        @error('starts_at')
                            <span style="color: #ff6b6b; font-size: 0.9rem; margin-top: 0.5rem; display: block;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Date d'expiration -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="expires_at" style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Date d'Expiration *
                        </label>
                        <input type="datetime-local" 
                               id="expires_at" 
                               name="expires_at" 
                               value="{{ old('expires_at') }}"
                               required
                               style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 6px; background: var(--bg-card); color: var(--text-primary);">
                        @error('expires_at')
                            <span style="color: #ff6b6b; font-size: 0.9rem; margin-top: 0.5rem; display: block;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Catégories Applicables -->
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; color: var(--gold); font-weight: 600;">
                            Catégories Applicables
                        </label>
                        
                        <div style="max-height: 200px; overflow-y: auto; border: 1px solid var(--border-color); border-radius: 6px; padding: 1rem; background: var(--bg-card);">
                            @foreach($categories as $category)
                                <label style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; cursor: pointer; padding: 0.5rem; border-radius: 4px; transition: background 0.3s ease;" 
                                       class="checkbox-item">
                                    <input type="checkbox" 
                                           name="categories[]" 
                                           value="{{ $category->id }}"
                                           {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                           style="accent-color: var(--gold);">
                                    <span style="color: var(--text-primary);">{{ $category->name }}</span>
                                </label>
                            @endforeach
                            
                            @if($categories->isEmpty())
                                <p style="color: var(--text-secondary); text-align: center; padding: 1rem;">
                                    Aucune catégorie disponible
                                </p>
                            @endif
                        </div>
                        @error('categories')
                            <span style="color: #ff6b6b; font-size: 0.9rem; margin-top: 0.5rem; display: block;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border-color);">
                <a href="{{ route('admin.promotions.index') }}" class="btn-outline-admin">
                    Annuler
                </a>
                <button type="submit" class="btn-admin">
                    🎁 Créer la Promotion
                </button>
            </div>
        </form>
    </div>

    <style>
        input, textarea, select {
            transition: all 0.3s ease;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--gold) !important;
            box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
        }

        .checkbox-item:hover {
            background: rgba(212, 175, 55, 0.1);
        }
    </style>

    <script>
        // Script pour mettre à jour le placeholder en fonction du type
        document.getElementById('type').addEventListener('change', function() {
            const valueInput = document.getElementById('value');
            if (this.value === 'percentage') {
                valueInput.placeholder = 'Ex: 20 pour 20% de réduction';
            } else if (this.value === 'fixed') {
                valueInput.placeholder = 'Ex: 5000 pour 5000 FCFA de réduction';
            }
        });
    </script>
@endsection