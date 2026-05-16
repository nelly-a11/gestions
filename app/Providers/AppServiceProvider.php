<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
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
        // Protection stricte de la base de données en production
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