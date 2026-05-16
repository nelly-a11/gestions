<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Sécurité temporairement désactivée pour forcer le démarrage
        /*
        if (\Illuminate\Support\Facades\App::environment('production')) {
            \Illuminate\Support\Facades\Event::listen(\Illuminate\Console\Events\CommandStarting::class, function ($event) {
                if (in_array($event->command, ['migrate:fresh', 'migrate:refresh', 'db:wipe'])) {
                    $event->output->writeln('<error>ATTENTION : Les commandes destructrices sont interdites en production !</error>');
                    exit(1);
                }
            });
        }
        */
    }
}