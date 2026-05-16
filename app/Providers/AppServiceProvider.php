<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Console\Events\CommandStarting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Bloque UNIQUEMENT si on tente un fresh/refresh en production via la console
        if (App::environment('production')) {
            Event::listen(CommandStarting::class, function (CommandStarting $event) {
                if (in_array($event->command, ['migrate:fresh', 'migrate:refresh', 'db:wipe'])) {
                    // On laisse passer si c'est le build initial de Railway, sinon on bloque
                    if (env('ALLOW_INITIAL_MIGRATE') !== true) {
                        $event->output->writeln('<error>ATTENTION : Les commandes destructrices sont interdites !</error>');
                        exit(1);
                    }
                }
            });
        }
    }
}