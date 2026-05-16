<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        // 1. On dit à MySQL de ne pas s'inquiéter de l'ordre des clés étrangères
        Schema::disableForeignKeyConstraints();

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->foreignId('position_id')->constrained()->cascadeOnDelete();
            $table->date('hired_at')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // 2. On réactive la sécurité une fois la table créée
        Schema::enableForeignKeyConstraints();
    }

    public function down() {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('employees');
        Schema::enableForeignKeyConstraints();
    }
};