#!/bin/bash

echo "🚀 [START] Démarrage du serveur PHP intégré de secours..."

# Nettoyage préventif des fichiers de cache
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Lancement du serveur intégré de PHP (Consommation : ~20 Mo de RAM contre 500 Mo pour FrankenPHP)
exec php -S 0.0.0.0:$PORT -t public/