# Déploiement sur Hostinger — instructions rapides

Ce document décrit les étapes pour préparer votre application Laravel locale afin de l'héberger sur un plan mutualisé Hostinger (ou tout autre hébergeur partagé). Le but : produire une archive ZIP prête à téléverser via le gestionnaire de fichiers Hostinger ou FTP.

Résumé des étapes (localement avant upload)

1. Installer les dépendances PHP (composer) et JS (npm) localement.
2. Générer la clé d'application et mettre à jour le fichier `.env` pour l'environnement de production.
3. Mettre en cache la configuration, les routes et les vues (optimisation Laravel).
4. Préparer les dossiers `storage` et `bootstrap/cache` et vérifier les permissions.
5. Construire les assets frontend (Vite/webpack) si présents.
6. Créer une archive ZIP contenant tous les fichiers nécessaires (y compris `vendor/`), prête à téléverser.

Important — secrets et sécurité

- Ne mettez jamais vos clés secrètes (mots de passe, clés API) dans un dépôt public. Préparez un `.env` de production localement et uploadez-le via le panneau Hostinger après l'upload (ou éditez-le via l'éditeur de fichiers). Je fournis un modèle ci-dessous.
- Hostinger exécute PHP côté serveur ; si vous ne pouvez pas exécuter Composer dans l'interface Hostinger, vous devez inclure le dossier `vendor/` dans l'archive.

Script automatique

J'ai ajouté `package_for_hostinger.ps1` (PowerShell) qui :

- vérifie la présence de Composer et npm (optionnel),
- exécute `composer install --no-dev --optimize-autoloader`,
- exécute `npm ci` et `npm run build` si `package.json` existe,
- génère `APP_KEY` (commande Laravel),
- met en cache config/routes/views,
- crée un fichier ZIP `hostinger_deploy.zip` prêt à uploader.

Avant d'exécuter le script

1. Copier `env.example` -> `.env` et remplir les valeurs de production (DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD, APP_URL, etc.). Le script ne remplace pas vos secrets automatiquement ; il demande à l'utilisateur de confirmer si `.env` existe.
2. Sur Windows PowerShell, exécutez :

```powershell
Set-Location C:\path\to\adj-arts
.\package_for_hostinger.ps1
```

Si vous ne voulez pas que le script crée `.env` automatiquement, créez `.env` manuellement à partir de `.env.example` et éditez-le.

Choix du DocumentRoot sur Hostinger

Option A (recommandée si votre hébergement le permet) : définissez le dossier public du site comme `public` (Document Root = /home/xxxx/public_html -> pointé vers /public du projet). Hostinger permet parfois de choisir le dossier racine via 'Manage' > 'Settings'.

Option B (si vous ne pouvez pas changer DocumentRoot) : déplacer le contenu de `public/` dans `public_html/` (ou racine web) et modifier les chemins dans `index.php` :

Ouvrez `public/index.php` et modifiez (exemples) :

```php
$app = require __DIR__.'/../bootstrap/app.php';
```

si vous placez les fichiers du dossier `public/` à la racine web (public_html), adaptez les chemins en remontant correctement vers `bootstrap` (par ex. `__DIR__.'/../bootstrap/app.php'` restaure le chemin si la structure est conservée). Si vous avez déplacé seulement les fichiers, mettez `__DIR__.'/../path/to/bootstrap/app.php'` selon l'emplacement final.

Après l'upload sur Hostinger

1. Uploadez l'archive ZIP via le File Manager ou FTP et extrayez-la dans le répertoire cible.
2. Si nécessaire, modifiez `index.php` comme indiqué (si vous avez déplacé `public` contents).
3. Assurez-vous que `storage/` et `bootstrap/cache/` sont accessibles en écriture par le serveur (chmod 775/755). Sur Hostinger, utilisez le File Manager pour définir les permissions.
4. Vérifiez que `.env` contient les bonnes variables de production. Éditez-le via l'éditeur Hostinger.
5. Si vous avez la possibilité, exécutez `php artisan migrate --force` depuis l'interface SSH (si disponible). Sinon, exécutez manuellement les migrations via phpMyAdmin en important les fichiers SQL si besoin.

Dépannage rapide

- Erreur 500 après upload : vérifier `storage/logs/laravel.log` et `.env` (APP_DEBUG=false en prod, mais temporairement mettre APP_DEBUG=true pour debug si nécessaire).
- Erreurs d'autoload : assurez-vous que `vendor/` est présent et contient les dépendances (ou que Composer a été exécuté sur le serveur).
- Liens symboliques (storage:link) : si `php artisan storage:link` ne fonctionne pas sur Hostinger (permissions), vous pouvez créer manuellement le dossier `public/storage` et y copier les fichiers ou configurer un chemin public.

Si vous voulez, je peux :

- Exécuter le script localement sur votre machine (si vous me donnez les accès nécessaires) et produire le ZIP.
- Vous guider pas-à‑pas via écran pour l'upload et la configuration sur Hostinger.
- Modifier `index.php` automatiquement pour la structure Hostinger (je peux préparer une version `public/index_hostinger.php` prête à remplacer après votre validation).

---
Mise en garde : n'uploadez jamais des secrets publics. Préparez `.env` localement, éditez-le juste après l'upload via l'éditeur Hostinger, ou utilisez les variables d'environnement si Hostinger les prend en charge.
