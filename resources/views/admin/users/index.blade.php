@extends('admin.layout')

@section('title', 'Gestion des Administrateurs')

@section('content')
    <div class="admin-header">
        <div>
            <h1>Gestion des Administrateurs</h1>
            <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                Gérez les comptes administrateurs de votre site
            </p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.users.create') }}" class="btn-admin">
                Nouvel Administrateur
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: rgba(37, 211, 102, 0.2); border: 1px solid #25D366; color: #25D366; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-card">
        @if($users->isEmpty())
            <div style="text-align: center; padding: 3rem; color: var(--text-secondary);">
                <div style="font-size: 4rem; margin-bottom: 1rem;">👥</div>
                <h3 style="color: var(--text-primary); margin-bottom: 1rem;">Aucun administrateur</h3>
                <p style="margin-bottom: 2rem;">Créez le premier compte administrateur.</p>
                <a href="{{ route('admin.users.create') }}" class="btn-admin">
                    Créer un administrateur
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th>Dernière connexion</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td style="display: flex; align-items: center; gap: 1rem;">
                                @if($user->avatar)
                                    <img src="{{ Storage::url($user->avatar) }}" 
                                         alt="{{ $user->name }}" 
                                         style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(212, 175, 55, 0.2); display: flex; align-items: center; justify-content: center; color: var(--admin-gold); font-weight: bold;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <strong style="color: var(--text-primary); display: block;">{{ $user->name }}</strong>
                                    <small style="color: var(--text-secondary);">Membre depuis {{ $user->created_at->format('m/Y') }}</small>
                                </div>
                            </td>
                            <td style="color: var(--text-secondary);">
                                {{ $user->email }}
                            </td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge badge-success">Administrateur</span>
                                @elseif($user->role === 'editor')
                                    <span class="badge badge-warning">Éditeur</span>
                                @else
                                    <span class="badge badge-secondary">Observateur</span>
                                @endif
                            </td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge badge-success">Actif</span>
                                @else
                                    <span class="badge badge-danger">Inactif</span>
                                @endif
                            </td>
                            <td style="color: var(--text-secondary);">
                                {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Jamais' }}
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    <a href="{{ route('admin.users.edit', $user) }}" 
                                       class="btn-outline-admin" 
                                       style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">
                                        Éditer
                                    </a>
                                    @if($user->id !== Auth::id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                style="background: var(--admin-danger); color: white; border: none; padding: 0.3rem 0.6rem; border-radius: 4px; cursor: pointer; font-size: 0.8rem;">
                                            Supprimer
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
        @endif
    </div>

    <!-- Statistiques des rôles -->
    <div class="admin-card">
        <h2 style="color: var(--admin-gold); margin-bottom: 1.5rem;">Statistiques des Rôles</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
            <div style="text-align: center; padding: 1.5rem; background: rgba(37, 211, 102, 0.1); border-radius: 10px;">
                <div style="font-size: 2rem; color: #25D366; margin-bottom: 0.5rem;">{{ $users->where('role', 'admin')->count() }}</div>
                <div style="color: var(--text-secondary);">Administrateurs</div>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: rgba(255, 193, 7, 0.1); border-radius: 10px;">
                <div style="font-size: 2rem; color: #FFC107; margin-bottom: 0.5rem;">{{ $users->where('role', 'editor')->count() }}</div>
                <div style="color: var(--text-secondary);">Éditeurs</div>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: rgba(108, 117, 125, 0.1); border-radius: 10px;">
                <div style="font-size: 2rem; color: #6c757d; margin-bottom: 0.5rem;">{{ $users->where('role', 'viewer')->count() }}</div>
                <div style="color: var(--text-secondary);">Observateurs</div>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: rgba(212, 175, 55, 0.1); border-radius: 10px;">
                <div style="font-size: 2rem; color: var(--admin-gold); margin-bottom: 0.5rem;">{{ $users->count() }}</div>
                <div style="color: var(--text-secondary);">Total</div>
            </div>
        </div>
    </div>
@endsection