# Déploiement — instructions rapides

Options recommandées (choisir 1) :

- Render (simple avec Docker)
- Fly.io (simple si vous préférez flyctl)
- DigitalOcean App Platform (aussi possible)

Ce que j'ai ajouté au dépôt

- `Dockerfile` — image Docker minimale qui lance `php artisan serve` sur le port ${PORT}.
- `.github/workflows/deploy-render.yml` — workflow GitHub Actions qui construit et déclenche une requête vers l'API Render afin de lancer un déploiement.

Étapes pour déployer via Render (recommandé pour débuter)

1. Créez un compte sur https://render.com (gratuit/essai selon l'offre actuelle).
2. Dans Render, créez un nouveau service de type "Web Service" et connectez-le à ce dépôt GitHub (`docteurweb24-ship-it/adjartsllc`) — Render peut automatiquement se connecter et builder depuis le repo.
   - Option alternative : créez le service mais utilisez la méthode "Dockerfile" si on veut contrôler la construction.
3. Dans les paramètres GitHub du dépôt, créez deux secrets (Repository > Settings > Secrets & variables > Actions):
   - `RENDER_API_KEY` — vous trouverez (ou créez) un API Key dans Render (Account > API Keys).
   - `RENDER_SERVICE_ID` — l'ID du service Render (disponible sur la page du service, ou via API).
4. Poussez les changements (les fichiers que j'ai ajoutés sont déjà dans le repo). Le workflow `deploy-render` se déclenchera sur `main` et enverra une requête à l'API Render pour demander un déploiement.

Si vous voulez que je pousse et déclenche le déploiement pour vous automatiquement :

- Donnez-moi `RENDER_API_KEY` et `RENDER_SERVICE_ID` à ajouter comme secrets GitHub (ou ajoutez-les vous-même et dites "prêt").
- Ou, autorisez-moi à accéder à votre compte Render (moins recommandé). Je préfère que vous ajoutiez les secrets.

Si vous préférez que je déploie directement (sans Render) :

- Donnez-moi un accès à une plateforme (Fly.io token, Railway token, ou Docker registry + serveur), ou je peux vous guider pas à pas.

Notes

- Le Dockerfile et la méthode `php artisan serve` servent pour une mise en ligne rapide mais n'est pas optimisée pour la production — recommandation : configurer nginx + php-fpm ou utiliser un service managé (Cloud Run, App Platform) pour la production.
- Si vous voulez, je peux aussi ajouter une GitHub Action plus complète (build, tests PHPUnit, puis déploiement) — dites-moi si vous voulez tests automatiques aussi.
