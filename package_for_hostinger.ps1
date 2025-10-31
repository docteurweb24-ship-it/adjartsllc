<#
  package_for_hostinger.ps1
  Script PowerShell pour préparer un zip prêt à uploader sur Hostinger.

  Usage: exécutez depuis la racine du projet Laravel:
    .\package_for_hostinger.ps1

  Le script :
  - Vérifie Composer et npm (optionnel),
  - Exécute composer install --no-dev --optimize-autoloader,
  - Exécute npm ci && npm run build si package.json existe,
  - Exécute php artisan key:generate --force et met en cache config/routes/views,
  - Crée hostinger_deploy.zip (inclut vendor/)

  IMPORTANT: modifiez .env localement pour y placer les valeurs de production AVANT d'exécuter
  le script si vous voulez inclure .env. Par sécurité le script ne copie pas .env.example vers .env
  automatiquement sans confirmation.
#>

Param(
    [switch]$IncludeEnv  # si passé, copie .env.example -> .env (à éditer ensuite)
)

function AbortIfNoCommand($cmd, $installHint) {
    if (-not (Get-Command $cmd -ErrorAction SilentlyContinue)) {
        Write-Host "Commande '$cmd' introuvable. $installHint" -ForegroundColor Yellow
        return $false
    }
    return $true
}

Write-Host "Préparation du package Hostinger..." -ForegroundColor Cyan

$root = Get-Location

if ($IncludeEnv) {
    if (-not (Test-Path .env)) {
        if (Test-Path .env.example) {
            Copy-Item .env.example .env
            Write-Host ".env créé depuis .env.example — éditez .env avec vos valeurs de production avant le téléversement." -ForegroundColor Green
        } else {
            Write-Host ".env.example introuvable. Créez un .env manuellement." -ForegroundColor Red
        }
    } else {
        Write-Host ".env existe déjà — ne pas écraser." -ForegroundColor Yellow
    }
}

if (-not (AbortIfNoCommand 'composer' "Installez Composer : https://getcomposer.org/")) { exit 1 }

Write-Host "Installing PHP dependencies (composer install --no-dev --optimize-autoloader)..." -ForegroundColor Cyan
composer install --no-dev --optimize-autoloader
if ($LASTEXITCODE -ne 0) { Write-Host "Erreur Composer — corrigez localement puis relancez." -ForegroundColor Red; exit 1 }

if (Test-Path package.json) {
    if (AbortIfNoCommand 'npm' "Installez Node/npm : https://nodejs.org/") {
        Write-Host "Installing JS dependencies (npm ci) and building assets..." -ForegroundColor Cyan
        npm ci
        npm run build
    } else {
        Write-Host "package.json détecté mais npm introuvable — sautez l'étape build." -ForegroundColor Yellow
    }
}

if (-not (AbortIfNoCommand 'php' "Installez PHP CLI et ajoutez-le au PATH.")) { exit 1 }

Write-Host "Generating APP_KEY and caching config/routes/views..." -ForegroundColor Cyan
php artisan key:generate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

Write-Host "Preparing writable directories..." -ForegroundColor Cyan
New-Item -ItemType Directory -Force -Path storage\framework\cache | Out-Null
New-Item -ItemType Directory -Force -Path storage\framework\sessions | Out-Null
New-Item -ItemType Directory -Force -Path storage\framework\views | Out-Null
if (Test-Path bootstrap\cache) { Write-Host "bootstrap/cache exists." }

$zipName = "hostinger_deploy.zip"
if (Test-Path $zipName) { Remove-Item $zipName -Force }

Write-Host "Creating ZIP archive: $zipName (this may take a while)..." -ForegroundColor Cyan

# Files and folders to exclude
$exclude = @('.git', '.github', 'node_modules', 'tests', '.vscode')

# Build list of items to include
$items = Get-ChildItem -Force | Where-Object { $exclude -notcontains $_.Name }

# Use System.IO.Compression to create zip (works on Windows)
[Reflection.Assembly]::LoadWithPartialName('System.IO.Compression.FileSystem') | Out-Null
[System.IO.Compression.ZipFile]::CreateFromDirectory($(Get-Location).Path, $zipName)

Write-Host "Archive $zipName créée. Vérifiez son contenu puis téléversez-la sur Hostinger via FTP ou File Manager." -ForegroundColor Green

Write-Host "Rappels post-upload :" -ForegroundColor Magenta
Write-Host " - Placez le contenu du dossier 'public' dans le dossier public_html (ou configurez DocumentRoot vers /public)." -ForegroundColor Magenta
Write-Host " - Vérifiez .env (DB, mail, APP_URL...) et permissions sur storage/ et bootstrap/cache." -ForegroundColor Magenta

Write-Host "Script terminé." -ForegroundColor Cyan
