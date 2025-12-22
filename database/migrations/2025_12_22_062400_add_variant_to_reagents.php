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
        Schema::table('reagents', function (Blueprint $table) {
            $table->string('variant')->nullable()->after('name'); // e.g., "anhydrous", "nonahydrate"
            $table->string('full_name')->nullable()->after('variant'); // e.g., "Aluminium Nitrate Nonahydrate"
            
            // Remove unique constraint from name if it exists
            $table->dropUnique(['name']);
            
            // Add composite unique constraint on name + variant
            $table->unique(['name', 'variant']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reagents', function (Blueprint $table) {
            $table->dropUnique(['name', 'variant']);
            $table->dropColumn(['variant', 'full_name']);
            $table->unique('name');
        });
    }
};