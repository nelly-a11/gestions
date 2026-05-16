<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL; // 👈 Obligatoire pour forcer le HTTPS
use Illuminate\Console\Events\CommandStarting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Force le HTTPS en production pour supprimer l'alerte de sécurité du navigateur
        if (App::environment('production') || env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // 2. Protection stricte de la base de données en production contre Nixpacks/Railway
        if (App::environment('production')) {
            Event::listen(CommandStarting::class, function (CommandStarting $event) {
                // On cible uniquement les commandes qui SUPPRIMENT des données
                if (in_array($event->command, ['migrate:fresh', 'migrate:refresh', 'db:wipe'])) {
                    $event->output->writeln('<error>SÉCURITÉ : Suppression des tables interdite en production !</error>');
                    exit(1);
                }
            });
        }
    }
}