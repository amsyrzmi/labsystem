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
        Schema::create('reagents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Chemical name
            $table->enum('type', ['solid', 'liquid']); // Reagent type
            $table->float('molar_mass', 10, 4); // Molar mass in g/mol
            $table->float('density', 10, 4)->nullable(); // Density in g/cm³ (for liquids)
            $table->string('formula')->nullable(); // Chemical formula
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reagents');
    }
};