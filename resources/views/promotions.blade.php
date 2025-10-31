@extends('layouts.app')

@section('title', 'Promotions - ADJ ARTS')

@section('content')
<div class="container">
    <div style="max-width: 900px; margin: 0 auto;">
        <!-- Hero -->
        <section style="text-align: center; padding: 3rem 0;">
            <h1 class="text-gold" style="font-size: 3rem; margin-bottom: 1rem;">Promotions Exclusives</h1>
            <p class="text-cream" style="font-size: 1.3rem;">Profitez de nos offres spéciales sur l'artisanat africain d'exception</p>
        </section>

        <!-- Promotions -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            @foreach($promotions as $promotion)
            <div class="glass-card" style="border-left: 4px solid var(--gold);">
                <div style="display: grid; grid-template-columns: auto 1fr auto; gap: 2rem; align-items: center;">
                    <!-- Code -->
                    <div style="text-align: center;">
                        <div style="background: rgba(212, 175, 55, 0.1); padding: 1.5rem; border-radius: 8px; border: 2px dashed var(--gold);">
                            <h3 class="text-gold" style="font-size: 1.8rem; margin-bottom: 0.5rem;">{{ $promotion->code }}</h3>
                            <small class="text-cream">Code promo</small>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="text-cream" style="margin-bottom: 0.5rem; font-size: 1.3rem;">{{ $promotion->description }}</h3>
                        <p class="text-gold" style="font-size: 1.2rem; margin-bottom: 0.5rem;">
                            @if($promotion->type === 'percentage')
                            🎁 {{ $promotion->value }}% DE RÉDUCTION
                            @else
                            🎁 {{ number_format($promotion->value, 0, ',', ' ') }} FCFA DE RÉDUCTION
                            @endif
                        </p>
                        @if($promotion->min_amount)
                        <p class="text-pink" style="font-size: 0.9rem;">
                            📦 Minimum d'achat : {{ number_format($promotion->min_amount, 0, ',', ' ') }} FCFA
                        </p>
                        @endif
                        <p class="text-cream" style="font-size: 0.9rem; opacity: 0.8;">
                            ⏳ Valable du {{-- Au lieu de $promotion->start_date->format() --}}
{{ \Carbon\Carbon::parse($promotion->start_date)->format('d/m/Y') }}
                    </div>

                    <!-- Statut -->
                    <div style="text-align: center;">
                        @if($promotion->isValid())
                        <span style="background: #25D366; color: white; padding: 0.5rem 1rem; border-radius: 20px; font-weight: bold; display: inline-block; margin-bottom: 0.5rem;">
                            ✅ ACTIVE
                        </span>
                        @else
                        <span style="background: #6c757d; color: white; padding: 0.5rem 1rem; border-radius: 20px; font-weight: bold; display: inline-block; margin-bottom: 0.5rem;">
                            ❌ EXPIRÉE
                        </span>
                        @endif
                        <br>
                        <small class="text-cream">
                            🔄 Utilisations : {{ $promotion->used_count }}
                            @if($promotion->usage_limit)
                            / {{ $promotion->usage_limit }}
                            @endif
                        </small>
                    </div>
                </div>
            </div>
            @endforeach

            @if($promotions->isEmpty())
            <div class="glass-card" style="text-align: center; padding: 4rem;">
                <div style="font-size: 4rem; margin-bottom: 1rem;">🎁</div>
                <h3 class="text-gold" style="margin-bottom: 1rem;">Aucune promotion en cours</h3>
                <p class="text-cream" style="margin-bottom: 2rem;">
                    Revenez régulièrement pour découvrir nos offres exclusives
                </p>
                <a href="/collections" class="btn-gold">✨ Découvrir les Collections</a>
            </div>
            @endif
        </div>

        <!-- Avantages -->
        <section style="margin: 4rem 0;">
            <h2 class="text-gold" style="text-align: center; margin-bottom: 3rem;">Pourquoi Choisir ADJ ARTS</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div class="glass-card" style="text-align: center; padding: 2rem;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">⭐</div>
                    <h4 class="text-gold">Authenticité Garantie</h4>
                    <p class="text-cream" style="font-size: 0.9rem;">Toutes nos œuvres sont certifiées artisanales</p>
                </div>
                <div class="glass-card" style="text-align: center; padding: 2rem;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🚚</div>
                    <h4 class="text-gold">Livraison Offerte</h4>
                    <p class="text-cream" style="font-size: 0.9rem;">À partir de 100.000 FCFA d'achat</p>
                </div>
                <div class="glass-card" style="text-align: center; padding: 2rem;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">💝</div>
                    <h4 class="text-gold">Impact Social</h4>
                    <p class="text-cream" style="font-size: 0.9rem;">Soutien direct aux artisans africains</p>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection