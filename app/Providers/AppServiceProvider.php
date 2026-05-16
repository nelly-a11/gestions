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
        // Bloque manuellement les commandes destructrices en production
        if (App::environment('production')) {
            Event::listen(CommandStarting::class, function (CommandStarting $event) {
                if (in_array($event->command, ['migrate:fresh', 'migrate:refresh', 'db:wipe'])) {
                    $event->output->writeln('<error>ATTENTION : Les commandes destructrices sont interdites en production !</error>');
                    exit(1);
                }
            });
        }
    }
}