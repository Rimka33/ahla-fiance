# Script PowerShell pour préparer l'archive de déploiement Elastic Beanstalk
# Usage: .\prepare-deploy.ps1

Write-Host "Preparation de l'archive de deploiement pour Elastic Beanstalk..." -ForegroundColor Green

# Nom de l'archive
$archiveName = "ahla-finance-deploy.zip"
$tempDir = "deploy-temp"

# Créer le répertoire temporaire
if (Test-Path $tempDir) {
    Remove-Item -Recurse -Force $tempDir
}
New-Item -ItemType Directory -Path $tempDir | Out-Null

Write-Host "Copie des fichiers necessaires..." -ForegroundColor Yellow

# Fichiers et dossiers à inclure
$filesToInclude = @(
    "app",
    "bootstrap",
    "config",
    "database",
    "public",
    "resources",
    "routes",
    "storage",
    ".ebextensions",
    ".platform",
    "artisan",
    "composer.json",
    "composer.lock",
    "Procfile"
)

# Copier les fichiers
foreach ($item in $filesToInclude) {
    if (Test-Path $item) {
        Write-Host "  Copie: $item" -ForegroundColor Gray
        Copy-Item -Path $item -Destination $tempDir -Recurse -Force
    }
}

# Copier package.json si présent
if (Test-Path "package.json") {
    Copy-Item -Path "package.json" -Destination $tempDir -Force
    Write-Host "  Copie: package.json" -ForegroundColor Gray
}

# Copier Procfile si présent
if (Test-Path "Procfile") {
    Copy-Item -Path "Procfile" -Destination $tempDir -Force
    Write-Host "  Copie: Procfile" -ForegroundColor Gray
}

# Nettoyer storage/logs
if (Test-Path "$tempDir\storage\logs") {
    Get-ChildItem "$tempDir\storage\logs\*" -Exclude ".gitkeep" | Remove-Item -Force
    Write-Host "  Nettoyage: storage/logs" -ForegroundColor Gray
}

# Créer l'archive ZIP
Write-Host "`nCreation de l'archive ZIP..." -ForegroundColor Yellow

if (Test-Path $archiveName) {
    Remove-Item $archiveName -Force
}

# Utiliser Compress-Archive
Compress-Archive -Path "$tempDir\*" -DestinationPath $archiveName -Force

# Nettoyer
Remove-Item -Recurse -Force $tempDir

Write-Host "`nArchive creee avec succes: $archiveName" -ForegroundColor Green
Write-Host "Taille: $((Get-Item $archiveName).Length / 1MB) MB" -ForegroundColor Green
Write-Host "`nVous pouvez maintenant uploader cette archive dans Elastic Beanstalk." -ForegroundColor Cyan

