#!/bin/bash

cd /var/app/current

# Exécuter les migrations
php artisan migrate --force

# Créer l'utilisateur admin (si n'existe pas)
php artisan db:seed --class=AdminUserSeeder --force

# Optimiser l'application
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Créer le lien symbolique storage
php artisan storage:link || true

