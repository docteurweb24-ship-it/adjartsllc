@extends('admin.layout')

@section('title', 'Gestion des Promotions')

@section('content')
    <div class="header">
        <h1>🎁 Gestion des Promotions</h1>
        <a href="{{ route('admin.promotions.create') }}" class="btn-admin">
            ➕ Nouvelle Promotion
        </a>
    </div>

    <div class="admin-card">
        @if(session('success'))
            <div style="background: rgba(37, 211, 102, 0.2); border: 1px solid #25D366; color: #25D366; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($promotions->isEmpty())
            <div style="text-align: center; padding: 3rem; color: var(--text-secondary);">
                <div style="font-size: 4rem; margin-bottom: 1rem;">🎁</div>
                <h3 style="color: var(--text-primary); margin-bottom: 1rem;">Aucune promotion</h3>
                <p style="margin-bottom: 2rem;">Créez votre première promotion pour commencer.</p>
                <a href="{{ route('admin.promotions.create') }}" class="btn-admin">
                    ➕ Créer une promotion
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Valeur</th>
                            <th>Dates</th>
                            <th>Statut</th>
                            <th>Utilisations</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $promotion)
                        <tr>
                            <td>
                                <strong style="color: var(--gold);">{{ $promotion->code }}</strong>
                            </td>
                            <td style="max-width: 200px;">
                                <div style="color: var(--text-primary);">{{ Str::limit($promotion->description, 50) }}</div>
                            </td>
                            <td>
                                @if($promotion->type === 'percentage')
                                    <span class="badge badge-info">Pourcentage</span>
                                @else
                                    <span class="badge badge-warning">Montant fixe</span>
                                @endif
                            </td>
                            <td>
                                @if($promotion->type === 'percentage')
                                    <strong style="color: var(--gold);">{{ $promotion->value }}%</strong>
                                @else
                                    <strong style="color: var(--gold);">{{ number_format($promotion->value, 0, ',', ' ') }} FCFA</strong>
                                @endif
                                @if($promotion->min_amount)
                                    <br>
                                    <small style="color: var(--text-secondary);">Min: {{ number_format($promotion->min_amount, 0, ',', ' ') }} FCFA</small>
                                @endif
                            </td>
                            <td style="min-width: 200px;">
                                <div style="font-size: 0.85rem;">
                                    <div style="color: var(--text-primary);">
                                        <strong>Début:</strong> {{ $promotion->starts_at->format('d/m/Y H:i') }}
                                    </div>
                                    <div style="color: var(--text-secondary);">
                                        <strong>Fin:</strong> {{ $promotion->expires_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{-- CORRECTION : Utilisation de isActive au lieu de isValid() --}}
                                @if($promotion->isActive)
                                    <span class="badge badge-success">✅ Active</span>
                                @elseif($promotion->expires_at < now())
                                    <span class="badge badge-secondary">❌ Expirée</span>
                                @else
                                    <span class="badge badge-info">⏳ À venir</span>
                                @endif
                                
                                @if(!$promotion->is_active)
                                    <span class="badge badge-secondary" style="margin-top: 0.25rem; display: block;">Désactivée</span>
                                @endif
                            </td>
                            <td>
                                @if($promotion->usage_limit)
                                    <div style="text-align: center;">
                                        <strong style="color: var(--gold);">{{ $promotion->used_count }}</strong>
                                        <span style="color: var(--text-secondary);">/</span>
                                        <span style="color: var(--text-primary);">{{ $promotion->usage_limit }}</span>
                                    </div>
                                @else
                                    <span style="color: var(--text-secondary);">Illimitée</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    <a href="{{ route('admin.promotions.edit', $promotion) }}" 
                                       class="btn-outline-admin" 
                                       style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">
                                        ✏️
                                    </a>
                                    <form action="{{ route('admin.promotions.destroy', $promotion) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette promotion ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                style="background: #ff6b6b; color: white; border: none; padding: 0.3rem 0.6rem; border-radius: 4px; cursor: pointer; font-size: 0.8rem;">
                                            🗑️
                                        </button>
                                    </form>
                                    @if($promotion->is_active)
                                        <form action="{{ route('admin.promotions.update', $promotion) }}" 
                                              method="POST" 
                                              style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_active" value="0">
                                            <button type="submit" 
                                                    style="background: #ffc107; color: black; border: none; padding: 0.3rem 0.6rem; border-radius: 4px; cursor: pointer; font-size: 0.8rem;"
                                                    title="Désactiver">
                                                ⏸️
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.promotions.update', $promotion) }}" 
                                              method="POST" 
                                              style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_active" value="1">
                                            <button type="submit" 
                                                    style="background: #25D366; color: white; border: none; padding: 0.3rem 0.6rem; border-radius: 4px; cursor: pointer; font-size: 0.8rem;"
                                                    title="Activer">
                                                ▶️
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Statistiques des promotions -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border-color);">
                <div style="text-align: center;">
                    <div style="font-size: 2rem; color: var(--gold);">{{ $promotions->where('isActive', true)->count() }}</div>
                    <div style="color: var(--text-secondary); font-size: 0.9rem;">Promotions actives</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 2rem; color: var(--text-secondary);">{{ $promotions->where('expires_at', '<', now())->count() }}</div>
                    <div style="color: var(--text-secondary); font-size: 0.9rem;">Promotions expirées</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 2rem; color: #17a2b8;">{{ $promotions->where('starts_at', '>', now())->count() }}</div>
                    <div style="color: var(--text-secondary); font-size: 0.9rem;">Promotions à venir</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 2rem; color: var(--pink);">{{ $promotions->count() }}</div>
                    <div style="color: var(--text-secondary); font-size: 0.9rem;">Total</div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .table-responsive {
            overflow-x: auto;
        }

        .admin-table {
            min-width: 800px;
        }

        .badge {
            padding: 0.3rem 0.6rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success { background: #25D366; color: white; }
        .badge-warning { background: #FFC107; color: black; }
        .badge-info { background: #17a2b8; color: white; }
        .badge-secondary { background: #6c757d; color: white; }
    </style>
@endsection