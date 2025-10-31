@extends('admin.layout')

@section('title', 'Gestion des Articles')

@section('content')
    <div class="admin-page-header">
        <div>
            <h1>Gestion des Articles</h1>
            <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                Gérez les articles de votre blog ADJ ARTS
            </p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.blog-posts.create') }}" class="btn-admin">
                📝 Nouvel Article
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: rgba(37, 211, 102, 0.2); border: 1px solid #25D366; color: #25D366; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-card">
        @if($posts->isEmpty())
            <div style="text-align: center; padding: 3rem; color: var(--text-secondary);">
                <div style="font-size: 4rem; margin-bottom: 1rem;">📝</div>
                <h3 style="color: var(--text-primary); margin-bottom: 1rem;">Aucun article</h3>
                <p style="margin-bottom: 2rem;">Créez votre premier article de blog.</p>
                <a href="{{ route('admin.blog-posts.create') }}" class="btn-admin">
                    Créer un article
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    @if($post->featured_image)
                                        <img src="{{ Storage::url($post->featured_image) }}" 
                                             alt="{{ $post->title }}" 
                                             style="width: 60px; height: 60px; border-radius: 8px; object-fit: cover;">
                                    @else
                                        <div style="width: 60px; height: 60px; border-radius: 8px; background: rgba(212, 175, 55, 0.2); display: flex; align-items: center; justify-content: center; color: var(--admin-gold);">
                                            📄
                                        </div>
                                    @endif
                                    <div>
                                        <strong style="color: var(--text-primary); display: block;">{{ $post->title }}</strong>
                                        <small style="color: var(--text-secondary);">{{ $post->slug }}</small>
                                        @if($post->excerpt)
                                            <p style="color: var(--text-secondary); font-size: 0.85rem; margin: 0.25rem 0 0 0;">
                                                {{ Str::limit($post->excerpt, 100) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($post->is_published)
                                    <span style="background: rgba(37, 211, 102, 0.2); color: #25D366; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                        Publié
                                    </span>
                                @else
                                    <span style="background: rgba(108, 117, 125, 0.2); color: #6c757d; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                        Brouillon
                                    </span>
                                @endif
                            </td>
                            <td style="color: var(--text-secondary);">
                                {{ $post->created_at->format('d/m/Y') }}<br>
                                <small>{{ $post->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    <a href="{{ route('blog.show', $post->slug) }}" 
                                       target="_blank"
                                       style="background: rgba(37, 211, 102, 0.1); color: #25D366; border: 1px solid #25D366; padding: 0.3rem 0.6rem; border-radius: 4px; text-decoration: none; font-size: 0.8rem;">
                                        👁️ Voir
                                    </a>
                                    <a href="{{ route('admin.blog-posts.edit', $post) }}" 
                                       style="background: rgba(212, 175, 55, 0.1); color: var(--admin-gold); border: 1px solid var(--admin-gold); padding: 0.3rem 0.6rem; border-radius: 4px; text-decoration: none; font-size: 0.8rem;">
                                        ✏️ Éditer
                                    </a>
                                    <form action="{{ route('admin.blog-posts.destroy', $post) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                style="background: rgba(255, 107, 107, 0.1); color: var(--admin-danger); border: 1px solid var(--admin-danger); padding: 0.3rem 0.6rem; border-radius: 4px; cursor: pointer; font-size: 0.8rem;">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Statistiques simples -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border-color);">
                <div style="text-align: center; padding: 1rem; background: var(--bg-secondary); border-radius: 8px;">
                    <div style="font-size: 2rem; color: var(--admin-gold); font-weight: bold;">{{ $posts->count() }}</div>
                    <div style="color: var(--text-secondary); font-size: 0.85rem;">Total</div>
                </div>
                <div style="text-align: center; padding: 1rem; background: var(--bg-secondary); border-radius: 8px;">
                    <div style="font-size: 2rem; color: #25D366; font-weight: bold;">{{ $posts->where('is_published', true)->count() }}</div>
                    <div style="color: var(--text-secondary); font-size: 0.85rem;">Publiés</div>
                </div>
                <div style="text-align: center; padding: 1rem; background: var(--bg-secondary); border-radius: 8px;">
                    <div style="font-size: 2rem; color: #6c757d; font-weight: bold;">{{ $posts->where('is_published', false)->count() }}</div>
                    <div style="color: var(--text-secondary); font-size: 0.85rem;">Brouillons</div>
                </div>
            </div>
        @endif
    </div>
@endsection