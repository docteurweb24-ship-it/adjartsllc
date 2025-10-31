@extends('layouts.app')

@section('title', 'Blog - ADJ ARTS')

@section('content')
<div class="container">
    <!-- Hero Section Blog -->
    <section class="blog-hero">
        <h1 class="blog-title">Blog ADJ ARTS</h1>
        <p class="blog-subtitle">
            L'univers de l'artisanat africain à travers nos yeux
        </p>
    </section>

    <div class="blog-layout">
        <!-- Articles Principaux -->
        <div class="blog-main">
            <div class="blog-grid">
                @forelse($posts as $post)
                <div class="blog-card">
                    <!-- IMAGE ARTICLE -->
                   <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : '/storage/images/blog/default.jpg' }}" 
                         alt="{{ $post->title }}" 
                         class="blog-image"
                         onerror="this.src='https://via.placeholder.com/400x250/1a1a1a/D4AF37?text=ADJ+ARTS+BLOG'">
                    <div class="blog-card-content">
                        <div class="blog-meta">
                            <span class="blog-date">
                                {{ $post->published_at?->format('d M Y') ?? 'Date à venir' }}
                            </span>
                            <span class="blog-badge">
                                 Article
                            </span>
                        </div>
                        
                        <h3 class="blog-post-title">
                            {{ $post->title }}
                        </h3>
                        
                        <p class="blog-excerpt">
                            {{ $post->excerpt }}
                        </p>
                        
                        <a href="/blog/{{ $post->slug }}" class="blog-read-more">
                            Lire la suite
                        </a>
                    </div>
                </div>
                @empty
                <div class="blog-empty">
                    <div class="empty-icon"></div>
                    <h3 class="empty-title">À venir</h3>
                    <p class="empty-description">
                        Notre équipe prépare du contenu passionnant sur l'artisanat africain
                    </p>
                    <a href="/collections" class="empty-action">Découvrir nos collections</a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
            <div class="blog-pagination">
                {{ $posts->links() }}
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="blog-sidebar">
            <!-- À propos du blog -->
            <div class="sidebar-card">
                <h3 class="sidebar-title">À Propos</h3>
                <p class="sidebar-text">
                    Découvrez les coulisses de l'artisanat africain, les histoires de nos artisans, 
                    et l'univers unique d'ADJ ARTS.
                </p>
            </div>

            <!-- Catégories -->
            <div class="sidebar-card">
                <h3 class="sidebar-title">Catégories</h3>
                <div class="categories-list">
                    <a href="#" class="category-link">
                        Artisanat du Bois
                    </a>
                    <a href="#" class="category-link">
                         Portraits d'Artisans
                    </a>
                    <a href="#" class="category-link">
                         Culture Africaine
                    </a>
                    <a href="#" class="category-link">
                         Conseils & Entretien
                    </a>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="sidebar-card">
                <h3 class="sidebar-title">Newsletter</h3>
                <p class="sidebar-text">
                    Recevez nos articles et actualités exclusives
                </p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Votre email" class="newsletter-input">
                    <button type="submit" class="newsletter-button">
                         S'abonner
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Hero Section */
.blog-hero {
    text-align: center;
    padding: 4rem 0 3rem;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), transparent);
    border-radius: 0 0 20px 20px;
    margin-bottom: 3rem;
}

.blog-title {
    font-size: 3rem;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, var(--gold), #f8e6b4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.blog-subtitle {
    font-size: 1.3rem;
    margin-bottom: 2rem;
    color: var(--text-secondary);
}

/* Layout */
.blog-layout {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 3rem;
    align-items: start;
}

/* Articles Principaux */
.blog-main {
    flex: 1;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
}

/* Carte d'article */
.blog-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.blog-card:hover {
    transform: translateY(-8px);
    border-color: rgba(212, 175, 55, 0.4);
    box-shadow: 0 12px 40px rgba(212, 175, 55, 0.15);
}

.blog-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}

.blog-card:hover .blog-image {
    transform: scale(1.05);
}

.blog-card-content {
    padding: 1.5rem;
}

.blog-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.blog-date {
    color: var(--pink);
    font-size: 0.9rem;
    font-weight: 500;
}

.blog-badge {
    background: rgba(212, 175, 55, 0.2);
    color: var(--gold);
    padding: 0.4rem 1rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.blog-post-title {
    color: var(--text-primary);
    font-size: 1.3rem;
    margin-bottom: 1rem;
    line-height: 1.4;
    font-weight: 600;
}

.blog-excerpt {
    color: var(--text-secondary);
    opacity: 0.9;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.blog-read-more {
    display: block;
    text-align: center;
    padding: 0.8rem 1.5rem;
    background: transparent;
    color: var(--gold);
    border: 2px solid var(--gold);
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 600;
}

.blog-read-more:hover {
    background: rgba(212, 175, 55, 0.1);
    transform: translateY(-2px);
}

/* État vide */
.blog-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    backdrop-filter: blur(10px);
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.7;
}

.empty-title {
    color: var(--gold);
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.empty-description {
    color: var(--text-secondary);
    margin-bottom: 2rem;
    font-size: 1.1rem;
    line-height: 1.6;
}

.empty-action {
    background: linear-gradient(135deg, var(--gold), #b8941f);
    color: black;
    padding: 1rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 600;
}

.empty-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
}

/* Pagination */
.blog-pagination {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
    padding: 1.5rem;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

/* Sidebar */
.blog-sidebar {
    position: sticky;
    top: 120px;
}

.sidebar-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.sidebar-card:hover {
    border-color: rgba(212, 175, 55, 0.3);
    transform: translateY(-2px);
}

.sidebar-title {
    color: var(--gold);
    margin-bottom: 1rem;
    font-size: 1.2rem;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 0.5rem;
}

.sidebar-text {
    color: var(--text-secondary);
    line-height: 1.6;
    font-size: 0.95rem;
}

/* Catégories */
.categories-list {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
}

.category-link {
    color: var(--text-secondary);
    text-decoration: none;
    padding: 0.8rem 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.category-link:hover {
    background: rgba(212, 175, 55, 0.05);
    color: var(--text-primary);
    border-left-color: var(--gold);
    transform: translateX(5px);
}

/* Newsletter */
.newsletter-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.newsletter-input {
    width: 100%;
    padding: 0.8rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(212, 175, 55, 0.3);
    border-radius: 8px;
    color: var(--text-primary);
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.newsletter-input:focus {
    outline: none;
    border-color: var(--gold);
    background: rgba(212, 175, 55, 0.05);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.newsletter-input::placeholder {
    color: var(--text-secondary);
}

.newsletter-button {
    width: 100%;
    padding: 0.8rem 1.5rem;
    background: linear-gradient(135deg, var(--gold), #b8941f);
    color: black;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.newsletter-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.blog-card, .sidebar-card {
    animation: fadeInUp 0.6s ease-out;
}

/* Responsive */
@media (max-width: 968px) {
    .blog-layout {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .blog-sidebar {
        position: static;
        order: 2;
    }
    
    .blog-main {
        order: 1;
    }
    
    .blog-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    }
}

@media (max-width: 768px) {
    .blog-hero {
        padding: 3rem 0 2rem;
    }
    
    .blog-title {
        font-size: 2.5rem;
    }
    
    .blog-subtitle {
        font-size: 1.1rem;
    }
    
    .blog-grid {
        grid-template-columns: 1fr;
    }
    
    .blog-card-content {
        padding: 1.25rem;
    }
    
    .sidebar-card {
        padding: 1.25rem;
    }
}

/* Animation au scroll */
.blog-card, .sidebar-card {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}
</style>

<script>
// Animation au scroll pour les cartes
document.addEventListener('DOMContentLoaded', function() {
    const blogCards = document.querySelectorAll('.blog-card');
    const sidebarCards = document.querySelectorAll('.sidebar-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    // Observer les cartes d'articles
    blogCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease, all 0.3s ease';
        observer.observe(card);
    });
    
    // Observer les cartes de la sidebar
    sidebarCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease, all 0.3s ease';
        observer.observe(card);
    });
    
    // Animation des images au hover
    const blogImages = document.querySelectorAll('.blog-image');
    blogImages.forEach(img => {
        img.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.08)';
        });
        
        img.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1.05)';
        });
    });
});
</script>
@endsection