@extends('layouts.app')

@section('title', 'Contact - ADJ ARTS')

@section('content')
<div class="container">
    <div class="contact-container">
        <!-- Hero -->
        <section class="contact-hero">
            <h1 class="contact-title">Contactez-nous</h1>
            <p class="contact-subtitle">Une question ? Un projet ? Nous sommes à votre écoute</p>
        </section>

        <div class="contact-grid">
            <!-- Informations de contact -->
            <div class="contact-info-section">
                <div class="contact-card">
                    <h3 class="contact-card-title">Nous Contacter</h3>
                    
                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="contact-icon"></div>
                            <div class="contact-details">
                                <p class="contact-label">Email</p>
                                <p class="contact-value">contact@adjartsllc.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="contact-icon"></div>
                            <div class="contact-details">
                                <p class="contact-label">WhatsApp</p>
                                <p class="contact-value">+229 XX XX XX XX</p>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="contact-icon"></div>
                            <div class="contact-details">
                                <p class="contact-label">Localisation</p>
                                <p class="contact-value">Bénin & International</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Horaires -->
                <div class="hours-card">
                    <h4 class="hours-title">Disponibilité</h4>
                    <div class="hours-list">
                        <p class="hours-item">Lun - Ven: 9h - 18h</p>
                        <p class="hours-item">Sam: 10h - 16h</p>
                        <p class="hours-item">Dimanche: Sur rendez-vous</p>
                    </div>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="form-card">
                <h3 class="form-title">Envoyez un Message</h3>

                @if(session('success'))
                <div class="success-message">
                    ✅ {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contact') }}" method="POST" class="contact-form">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nom complet *</label>
                            <input type="text" name="name" required class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" required class="form-input">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sujet *</label>
                        <input type="text" name="subject" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message *</label>
                        <textarea name="message" rows="6" required class="form-textarea"></textarea>
                    </div>

                    <button type="submit" class="submit-button">
                        Envoyer le Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Container principal */
.contact-container {
    max-width: 1000px;
    margin: 0 auto;
}

/* Hero Section */
.contact-hero {
    text-align: center;
    padding: 3rem 0 4rem;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), transparent);
    border-radius: 0 0 20px 20px;
    margin-bottom: 2rem;
}

.contact-title {
    font-size: 3rem;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, var(--gold), #f8e6b4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.contact-subtitle {
    font-size: 1.3rem;
    color: var(--text-secondary);
}

/* Grid Layout */
.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
}

/* Cartes de contact */
.contact-card, .hours-card, .form-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 2rem;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.contact-card:hover, .hours-card:hover, .form-card:hover {
    border-color: rgba(212, 175, 55, 0.4);
    transform: translateY(-2px);
}

.contact-card-title, .form-title {
    color: var(--gold);
    margin-bottom: 2rem;
    font-size: 1.5rem;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 0.5rem;
}

/* Méthodes de contact */
.contact-methods {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.contact-method {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.contact-method:hover {
    background: rgba(212, 175, 55, 0.05);
    border-color: rgba(212, 175, 55, 0.2);
    transform: translateX(5px);
}

.contact-icon {
    font-size: 2rem;
    flex-shrink: 0;
}

.contact-details {
    flex: 1;
}

.contact-label {
    color: var(--pink);
    font-weight: bold;
    margin-bottom: 0.3rem;
    font-size: 1rem;
}

.contact-value {
    color: var(--text-primary);
    font-size: 1rem;
}

/* Horaires */
.hours-card {
    margin-top: 2rem;
}

.hours-title {
    color: var(--gold);
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.hours-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.hours-item {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    padding-left: 1rem;
    position: relative;
}

.hours-item::before {
    content: '•';
    color: var(--gold);
    position: absolute;
    left: 0;
}

/* Formulaire */
.success-message {
    background: rgba(37, 211, 102, 0.1);
    border: 1px solid #25D366;
    color: #25D366;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    text-align: center;
    animation: slideIn 0.5s ease-out;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-weight: 500;
    font-size: 0.95rem;
}

.form-input, .form-textarea {
    width: 100%;
    padding: 0.8rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(212, 175, 55, 0.3);
    border-radius: 8px;
    color: var(--text-primary);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-input:focus, .form-textarea:focus {
    outline: none;
    border-color: var(--gold);
    background: rgba(212, 175, 55, 0.05);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
}

.submit-button {
    width: 100%;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, var(--gold), #b8941f);
    color: black;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.submit-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
}

.submit-button:active {
    transform: translateY(0);
}

/* Animations */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.contact-card, .hours-card, .form-card {
    animation: fadeInUp 0.6s ease-out;
}

/* Responsive */
@media (max-width: 968px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .contact-hero {
        padding: 2rem 0 3rem;
    }
    
    .contact-title {
        font-size: 2.5rem;
    }
}

@media (max-width: 768px) {
    .contact-container {
        padding: 0 1rem;
    }
    
    .contact-title {
        font-size: 2rem;
    }
    
    .contact-subtitle {
        font-size: 1.1rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .contact-card, .hours-card, .form-card {
        padding: 1.5rem;
    }
    
    .contact-method {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .contact-icon {
        font-size: 1.5rem;
    }
}

/* Effets de focus améliorés */
.form-input:focus::placeholder,
.form-textarea:focus::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

/* États de validation */
.form-input:valid {
    border-color: rgba(37, 211, 102, 0.3);
}

.form-input:invalid:not(:focus):not(:placeholder-shown) {
    border-color: rgba(255, 107, 107, 0.3);
}
</style>

<script>
// Animation au scroll
document.addEventListener('DOMContentLoaded', function() {
    const contactCards = document.querySelectorAll('.contact-card, .hours-card, .form-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    contactCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease, border-color 0.3s ease';
        observer.observe(card);
    });
    
    // Effet de focus amélioré pour les inputs
    const formInputs = document.querySelectorAll('.form-input, .form-textarea');
    
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
});
</script>
@endsection