<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // On désactive la vérification stricte des clés étrangères temporairement
        Schema::disableForeignKeyConstraints();

        Schema::create('position_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date')->nullable(); // Null si c'est le poste actuel
            $table->timestamps();
        });

        // On réactive la sécurité une fois la table créée
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('position_histories');
        Schema::enableForeignKeyConstraints();
    }
}