<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE employees MODIFY status ENUM('active','inactive','on_leave') NOT NULL DEFAULT 'active'");
        } elseif ($driver === 'pgsql') {
            DB::statement("ALTER TABLE employees ALTER COLUMN status TYPE TEXT");
            DB::statement("ALTER TABLE employees ALTER COLUMN status SET DEFAULT 'active'");
            // NOTE: PostgreSQL enum conversion is complex; on test environment we may not need strict enum.
        } elseif ($driver === 'sqlite') {
            Schema::table('employees', function (Blueprint $table) {
                $table->string('status')->default('active')->change();
            });
        }
    }

    public function down()
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE employees MODIFY status ENUM('active','inactive') NOT NULL DEFAULT 'active'");
        } elseif ($driver === 'pgsql') {
            // restore to text with limited semantics
            DB::statement("ALTER TABLE employees ALTER COLUMN status TYPE TEXT");
            DB::statement("ALTER TABLE employees ALTER COLUMN status SET DEFAULT 'active'");
        } elseif ($driver === 'sqlite') {
            Schema::table('employees', function (Blueprint $table) {
                $table->string('status')->default('active')->change();
            });
        }
    }
};
