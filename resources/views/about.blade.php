@extends('layouts.app')

@section('title', 'À Propos - ADJ ARTS')

@section('content')
<div class="container">
    <!-- Hero Section Redesign -->
    <section class="about-hero">
        <div class="hero-content">
            <div class="hero-text">
                <div class="logo-reveal">
                    <h1 class="hero-title">Notre Histoire</h1>
                    <div class="title-underline"></div>
                </div>
                <p class="hero-subtitle">L'âme de l'artisanat africain réinventée</p>
                <p class="hero-description">
                    Découvrez le parcours exceptionnel d'ADJ ARTS, 
                    une odyssée artistique qui unit tradition africaine 
                    et excellence contemporaine.
                </p>
            </div>
            <div class="hero-visual">
                <div class="floating-artwork">
                    <div class="art-piece piece-1"></div>
                    <div class="art-piece piece-2"></div>
                    <div class="art-piece piece-3"></div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <span>Explorer notre histoire</span>
            <div class="arrow"></div>
        </div>
    </section>

    <!-- Notre Histoire -->
    <section class="story-section">
        <div class="section-header">
            <h2 class="section-title">La Naissance d'une Vision</h2>
            <p class="section-subtitle">Du Bénin au monde</p>
        </div>
        
        <div class="story-timeline">
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">2018</div>
                    <h3>Les Origines</h3>
                    <p>
                        ADJ ARTS naît de la passion d'<strong class="text-gold">Adjike Rissikathou Tidjani</strong>, 
                        entrepreneure d'origine béninoise, pour l'artisanat africain. Son vision : 
                        créer un pont entre les savoir-faire ancestraux et le design contemporain.
                    </p>
                </div>
                <div class="timeline-visual">
                    <div class="visual-placeholder">
                        <span>Origines</span>
                    </div>
                </div>
            </div>

            <div class="timeline-item reverse">
                <div class="timeline-content">
                    <div class="timeline-year">2020</div>
                    <h3>L'Évolution</h3>
                    <p>
                        Installation aux États-Unis et développement d'une vision globale. 
                        ADJ ARTS devient une plateforme dédiée à la valorisation des artisans 
                        africains et à la préservation du patrimoine culturel.
                    </p>
                </div>
                <div class="timeline-visual">
                    <div class="visual-placeholder">
                        <span>Évolution</span>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">2024</div>
                    <h3>L'Excellence</h3>
                    <p>
                        Aujourd'hui, ADJ ARTS représente l'excellence de l'artisanat africain 
                        avec plus de 50 artisans partenaires, 100+ créations uniques 
                        et une présence dans 10+ pays.
                    </p>
                </div>
                <div class="timeline-visual">
                    <div class="visual-placeholder">
                        <span>Excellence</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="mission-vision-section">
        <div class="mv-container">
            <div class="mv-card mission-card">
                <div class="mv-icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <h3>Notre Mission</h3>
                <p>
                    Valoriser l'artisanat africain authentique en créant des ponts durables 
                    entre les artisans et le marché international, tout en préservant 
                    les techniques ancestrales et en promouvant l'innovation.
                </p>
            </div>

            <div class="mv-card vision-card">
                <div class="mv-icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                    </svg>
                </div>
                <h3>Notre Vision</h3>
                <p>
                    Devenir la référence mondiale de l'artisanat africain premium, 
                    reconnue pour son excellence artistique, son impact social positif 
                    et son engagement en faveur du développement durable.
                </p>
            </div>
        </div>
    </section>

    <!-- Valeurs -->
    <section class="values-section">
        <div class="section-header">
            <h2 class="section-title">Nos Valeurs Fondamentales</h2>
            <p class="section-subtitle">Le cœur de notre engagement</p>
        </div>
        
        <div class="values-grid">
            <div class="value-card" data-aos="fade-up">
                <div class="value-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                    </svg>
                </div>
                <h4>Authenticité</h4>
                <p>Chaque pièce raconte une histoire unique, fruit de savoir-faire ancestraux transmis de génération en génération.</p>
            </div>

            <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                <div class="value-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <h4>Qualité</h4>
                <p>Exigence absolue dans le choix des matériaux et la finition pour des œuvres qui traversent le temps.</p>
            </div>

            <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                <div class="value-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                    </svg>
                </div>
                <h4>Innovation</h4>
                <p>Allier tradition et modernité pour créer des pièces uniques qui dialoguent avec notre époque.</p>
            </div>

            <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                <div class="value-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C13.1 2 14 2.9 14 4S13.1 6 12 6 10 5.1 10 4 10.9 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <h4>Impact Social</h4>
                <p>Soutien direct aux communautés d'artisans et contribution au développement économique local.</p>
            </div>
        </div>
    </section>

    <!-- Impact Chiffres -->
    <section class="impact-section">
        <div class="impact-container">
            <div class="impact-header">
                <h2 class="section-title">Notre Impact en Chiffres</h2>
                <p class="section-subtitle">Des réalisations qui comptent</p>
            </div>
            
            <div class="impact-grid">
                <div class="impact-item" data-aos="zoom-in">
                    <div class="impact-number" data-count="50">0</div>
                    <div class="impact-label">Artisans Soutenus</div>
                </div>
                <div class="impact-item" data-aos="zoom-in" data-aos-delay="100">
                    <div class="impact-number" data-count="100">0</div>
                    <div class="impact-label">Œuvres Uniques</div>
                </div>
                <div class="impact-item" data-aos="zoom-in" data-aos-delay="200">
                    <div class="impact-number" data-count="10">0</div>
                    <div class="impact-label">Pays Desservis</div>
                </div>
                <div class="impact-item" data-aos="zoom-in" data-aos-delay="300">
                    <div class="impact-number" data-count="5">0</div>
                    <div class="impact-label">Années d'Expertise</div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* About Hero Section */
.about-hero {
    position: relative;
    min-height: 80vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 4rem 0;
    overflow: hidden;
}

.about-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 50%, rgba(212, 175, 55, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 192, 203, 0.05) 0%, transparent 50%),
        repeating-linear-gradient(45deg, 
            transparent, 
            transparent 10px, 
            rgba(212, 175, 55, 0.03) 10px, 
            rgba(212, 175, 55, 0.03) 20px
        );
    z-index: -1;
}

.hero-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

.hero-text {
    animation: fadeInUp 1s ease-out;
}

.hero-title {
    font-size: 4rem;
    font-weight: 300;
    letter-spacing: 2px;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, var(--gold), #f8e6b4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    opacity: 0.9;
    font-weight: 300;
}

.hero-description {
    font-size: 1.2rem;
    line-height: 1.8;
    opacity: 0.8;
    max-width: 500px;
}

/* Hero Visual */
.hero-visual {
    position: relative;
    height: 400px;
}

.floating-artwork {
    position: relative;
    width: 100%;
    height: 100%;
}

.art-piece {
    position: absolute;
    border-radius: 15px;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow);
    animation: float 6s ease-in-out infinite;
}

.piece-1 {
    width: 120px;
    height: 160px;
    top: 20%;
    left: 10%;
    background: linear-gradient(135deg, var(--gold), transparent);
    animation-delay: 0s;
}

.piece-2 {
    width: 180px;
    height: 120px;
    top: 50%;
    right: 20%;
    background: linear-gradient(135deg, var(--pink), transparent);
    animation-delay: 2s;
}

.piece-3 {
    width: 100px;
    height: 140px;
    bottom: 10%;
    left: 30%;
    background: linear-gradient(135deg, var(--bg-secondary), transparent);
    animation-delay: 4s;
}

/* Scroll Indicator */
.scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    color: var(--text-secondary);
    font-size: 0.9rem;
    animation: bounce 2s infinite;
}

.arrow {
    width: 2px;
    height: 20px;
    background: var(--gold);
    margin: 0.5rem auto 0;
    position: relative;
}

.arrow::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: -4px;
    width: 10px;
    height: 10px;
    border-right: 2px solid var(--gold);
    border-bottom: 2px solid var(--gold);
    transform: rotate(45deg);
}

/* Story Section */
.story-section {
    padding: 6rem 0;
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-title {
    font-size: 3rem;
    color: var(--gold);
    margin-bottom: 1rem;
    font-weight: 300;
}

.section-subtitle {
    font-size: 1.3rem;
    opacity: 0.8;
}

/* Timeline */
.story-timeline {
    max-width: 1000px;
    margin: 0 auto;
}

.timeline-item {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    margin-bottom: 6rem;
}

.timeline-item.reverse {
    direction: rtl;
}

.timeline-item.reverse > * {
    direction: ltr;
}

.timeline-year {
    font-size: 1.5rem;
    color: var(--gold);
    font-weight: bold;
    margin-bottom: 1rem;
}

.timeline-content h3 {
    font-size: 2rem;
    margin-bottom: 1.5rem;
    color: var(--text-primary);
}

.timeline-content p {
    font-size: 1.1rem;
    line-height: 1.8;
    opacity: 0.9;
}

.timeline-visual {
    height: 300px;
    border-radius: 15px;
    overflow: hidden;
}

.visual-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--bg-secondary), var(--border-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 1.5rem;
    font-weight: bold;
}

/* Mission & Vision */
.mission-vision-section {
    padding: 6rem 0;
    background: var(--bg-secondary);
}

.mv-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    max-width: 1000px;
    margin: 0 auto;
}

.mv-card {
    background: var(--bg-card);
    padding: 3rem;
    border-radius: 20px;
    text-align: center;
    border: 1px solid var(--border-color);
    transition: transform 0.3s ease;
}

.mv-card:hover {
    transform: translateY(-10px);
}

.mv-icon {
    color: var(--gold);
    margin-bottom: 2rem;
}

.mv-card h3 {
    font-size: 2rem;
    margin-bottom: 1.5rem;
    color: var(--gold);
}

.mv-card p {
    font-size: 1.1rem;
    line-height: 1.8;
    opacity: 0.9;
}

/* Values Section */
.values-section {
    padding: 6rem 0;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.value-card {
    background: var(--bg-card);
    padding: 2.5rem;
    border-radius: 15px;
    text-align: center;
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.value-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(212, 175, 55, 0.1);
}

.value-icon {
    color: var(--gold);
    margin-bottom: 1.5rem;
}

.value-card h4 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--text-primary);
}

.value-card p {
    opacity: 0.8;
    line-height: 1.6;
}

/* Impact Section */
.impact-section {
    padding: 6rem 0;
    background: linear-gradient(135deg, var(--bg-secondary), transparent);
}

.impact-container {
    max-width: 1000px;
    margin: 0 auto;
    text-align: center;
}

.impact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 3rem;
    margin-top: 4rem;
}

.impact-item {
    padding: 2rem;
}

.impact-number {
    font-size: 3.5rem;
    font-weight: bold;
    color: var(--gold);
    margin-bottom: 1rem;
}

.impact-label {
    font-size: 1.1rem;
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 1px;
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

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(5deg);
    }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0) translateX(-50%);
    }
    40% {
        transform: translateY(-10px) translateX(-50%);
    }
    60% {
        transform: translateY(-5px) translateX(-50%);
    }
}

/* Responsive */
@media (max-width: 968px) {
    .hero-content {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .hero-title {
        font-size: 3rem;
    }
    
    .timeline-item {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .mv-container {
        grid-template-columns: 1fr;
    }
    
    .impact-number {
        font-size: 2.5rem;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 2.5rem;
    }
    
    .values-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// Animated counter for impact numbers
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.impact-number');
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-count'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const updateCounter = () => {
            current += step;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target + '+';
            }
        };
        
        // Start counter when element is in viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCounter();
                    observer.unobserve(entry.target);
                }
            });
        });
        
        observer.observe(counter);
    });
    
    // Simple scroll animations
    const animatedElements = document.querySelectorAll('[data-aos]');
    
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        scrollObserver.observe(el);
    });
});
</script>
@endsection