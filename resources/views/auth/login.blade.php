<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - ADJ ARTS</title>
    <style>
        :root {
            --gold: #D4AF37;
            --gold-light: #f4e4a9;
            --dark-bg: #0a0a0a;
            --dark-light: #1a1a1a;
            --cream: #f8f4e9;
            --text-dark: #2d3748;
            --border-color: rgba(212, 175, 55, 0.3);
            --success: #25D366;
            --danger: #ff6b6b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-light) 100%);
            color: var(--cream);
            font-family: 'Raleway', Arial, sans-serif;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 3rem 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .login-card:hover {
            border-color: rgba(212, 175, 55, 0.5);
            box-shadow: 0 25px 80px rgba(212, 175, 55, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo {
            height: 80px;
            width: auto;
            margin-bottom: 1rem;
            filter: drop-shadow(0 5px 15px rgba(212, 175, 55, 0.3));
        }

        .login-title {
            font-size: 2rem;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            font-weight: 300;
        }

        .login-subtitle {
            color: var(--cream);
            opacity: 0.8;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--gold);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--cream);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
            background: rgba(255, 255, 255, 0.15);
        }

        .form-control::placeholder {
            color: rgba(248, 244, 233, 0.5);
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, var(--gold), #e6c158);
            color: var(--dark-bg);
            border: none;
            padding: 1rem 2rem;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
        }

        .login-footer a {
            color: var(--gold);
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .login-footer a:hover {
            opacity: 0.8;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: 1px solid;
        }

        .alert-success {
            background: rgba(37, 211, 102, 0.2);
            border-color: var(--success);
            color: var(--success);
        }

        .alert-danger {
            background: rgba(255, 107, 107, 0.2);
            border-color: var(--danger);
            color: var(--danger);
        }

        .errors {
            background: rgba(255, 107, 107, 0.1);
            border: 1px solid var(--danger);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .error-list {
            list-style: none;
        }

        .error-list li {
            color: var(--danger);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .error-list li:before {
            content: '⚠️';
        }

        /* Animation de fond */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.3;
        }

        .floating-shape {
            position: absolute;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            bottom: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 100px;
            height: 100px;
            top: 50%;
            left: 5%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
            }
            
            .login-title {
                font-size: 1.8rem;
            }
            
            body {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Animation de fond -->
    <div class="bg-animation">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="{{ asset('storage/images/logo.png') }}" 
                     alt="ADJ ARTS" 
                     class="login-logo"
                     onerror="this.style.display='none'">
                <h1 class="login-title">ADJ ARTS</h1>
                <p class="login-subtitle">Espace Administration</p>
            </div>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="errors">
                    <ul class="error-list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           required 
                           autofocus
                           class="form-control"
                           placeholder="admin@adj-arts.com">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required
                           class="form-control"
                           placeholder="Votre mot de passe">
                </div>

                <div class="form-group" style="display: flex; align-items: center; justify-content: space-between;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" 
                               name="remember"
                               style="accent-color: var(--gold);">
                        <span style="color: var(--cream); opacity: 0.8; font-size: 0.9rem;">
                            Se souvenir de moi
                        </span>
                    </label>

                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: var(--gold); text-decoration: none; font-size: 0.9rem;">
                        Mot de passe oublié ?
                    </a>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    Se connecter
                </button>
            </form>

            <div class="login-footer">
                <p style="color: var(--cream); opacity: 0.7; font-size: 0.9rem;">
                    Accès réservé au personnel autorisé
                </p>
                <a href="{{ url('/') }}" style="display: inline-block; margin-top: 1rem;">
                    ← Retour au site public
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation d'entrée
            const loginCard = document.querySelector('.login-card');
            loginCard.style.opacity = '0';
            loginCard.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                loginCard.style.transition = 'all 0.6s ease';
                loginCard.style.opacity = '1';
                loginCard.style.transform = 'translateY(0)';
            }, 100);

            // Focus sur le premier champ
            document.getElementById('email')?.focus();
        });
    </script>
</body>
</html>