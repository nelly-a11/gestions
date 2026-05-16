<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Crée la table positions avec ses relations.
     */
    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            
            // Le titre unique du poste
            $table->string('title')->unique();
            
            // Description détaillée (nullable)
            $table->text('description')->nullable();

            // Relation avec la table departments
            // On s'assure que la table 'departments' est créée AVANT celle-ci
            $table->foreignId('department_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Supprime la table.
     */
    public function down(): void
    {
        // Pour SQLite, on désactive les contraintes avant le drop pour éviter les conflits
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('positions');
        Schema::enableForeignKeyConstraints();
    }
}