<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('apellido')->after('name');
            $table->string('apellidosegundo')->after('apellido');
            $table->string('telefono')->after('apellidosegundo');
            $table->date('fechaNacimiento')->nullable()->after('telefono');
            $table->float('peso')->nullable()->after('fechaNacimiento');
            $table->float('altura')->nullable()->after('peso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
};
