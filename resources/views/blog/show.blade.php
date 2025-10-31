@extends('layouts.app')

@section('title', $post->title . ' - Blog ADJ ARTS')

@section('content')
<div class="container">
    <div style="max-width: 900px; margin: 0 auto;">
        <!-- Fil d'Ariane -->
        <nav style="margin: 2rem 0;">
            <a href="/" class="text-gold" style="text-decoration: none;">Accueil</a>
            <span class="text-cream" style="margin: 0 0.5rem;">›</span>
            <a href="/blog" class="text-gold" style="text-decoration: none;">Blog</a>
            <span class="text-cream" style="margin: 0 0.5rem;">›</span>
            <span class="text-cream">{{ Str::limit($post->title, 40) }}</span>
        </nav>

        <div class="glass-card" style="padding: 3rem;">
            <!-- En-tête Article -->
            <header style="text-align: center; margin-bottom: 3rem;">
                <span class="text-pink" style="font-size: 0.9rem; letter-spacing: 1px;">
                    {{ $post->published_at?->format('d M Y') ?? $post->created_at?->format('d M Y') ?? 'Date inconnue' }}
                </span>
                <h1 class="text-gold" style="font-size: 2.5rem; margin: 1rem 0; line-height: 1.3;">
                    {{ $post->title }}
                </h1>
                <p class="text-cream" style="font-size: 1.1rem; opacity: 0.9;">
                    Par l'équipe ADJ ARTS
                </p>
            </header>

           <!-- Image Principale -->
<div style="margin-bottom: 2.5rem;">
    <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : '/storage/images/blog/default.jpg' }}" 
         alt="{{ $post->title }}" 
         style="width: 100%; height: 400px; object-fit: cover; border-radius: 8px;"
         onerror="this.src='https://via.placeholder.com/800x400/1a1a1a/D4AF37?text=ADJ+ARTS'">
</div>

            <!-- Contenu Article -->
            <article class="text-cream" style="line-height: 1.8; font-size: 1.1rem;">
                {!! $post->content !!}
            </article>

            <!-- Partage -->
            <div style="margin-top: 4rem; padding-top: 2rem; border-top: 1px solid rgba(212,175,55,0.3);">
                <h4 class="text-gold" style="margin-bottom: 1rem;">Partager cet article</h4>
                <div style="display: flex; gap: 1rem;">
                    <a href="#" class="btn-outline-gold" style="padding: 0.8rem 1.5rem;">Facebook</a>
                    <a href="#" class="btn-outline-gold" style="padding: 0.8rem 1.5rem;"> Twitter</a>
                    <a href="#" class="btn-outline-gold" style="padding: 0.8rem 1.5rem;">LinkedIn</a>
                    <a href="#" class="btn-outline-gold" style="padding: 0.8rem 1.5rem;"> WhatsApp</a>
                </div>
            </div>
        </div>

        <!-- Articles Similaires -->
      @if(isset($recentPosts) && $recentPosts->count() > 0)
        <section style="margin: 4rem 0;">
            <h2 class="text-gold" style="text-align: center; margin-bottom: 3rem; font-size: 2rem;">
                 Articles Similaires
            </h2>
            <div class="products-grid">
                @foreach($recentPosts as $recentPost)
                <div class="product-card">
                    <img src="{{ $recentPost->featured_image ? asset('storage/' . $recentPost->featured_image) : '/storage/images/blog/default.jpg' }}" 
                         alt="{{ $recentPost->title }}" 
                         class="product-image"
                         onerror="this.src='https://via.placeholder.com/300x200/1a1a1a/D4AF37?text=ADJ+ARTS'">
                    <div class="product-info">
                        <span class="text-pink" style="font-size: 0.8rem;">
                            {{ $recentPost->published_at?->format('d M Y') ?? $recentPost->created_at?->format('d M Y') ?? 'Date inconnue' }}
                        </span>
                        <h4 class="text-cream" style="margin: 0.5rem 0; font-size: 1.1rem; line-height: 1.4;">
                            {{ $recentPost->title }}
                        </h4>
                        <a href="/blog/{{ $recentPost->slug }}" class="btn-outline-gold" style="display: block; text-align: center; margin-top: 1rem;">
                            Lire
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>

<style>
article h2 {
    color: var(--gold);
    margin: 2rem 0 1rem 0;
    font-size: 1.8rem;
}

article h3 {
    color: var(--pink);
    margin: 1.5rem 0 1rem 0;
    font-size: 1.4rem;
}

article p {
    margin-bottom: 1.5rem;
}

article ul, article ol {
    margin: 1rem 0 1.5rem 2rem;
}

article li {
    margin-bottom: 0.5rem;
}
</style>
@endsection