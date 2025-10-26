<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lab_requests', function (Blueprint $table) {
            // Approved/scheduled date and time (can differ from preferred)
            $table->date('approved_date')->nullable()->after('preferred_time');
            $table->time('approved_time')->nullable()->after('approved_date');
            
            // Duration in minutes (default 60 minutes = 1 hour)
            $table->unsignedInteger('duration')->default(60)->after('approved_time');
            
            // When it was approved
            $table->timestamp('approved_at')->nullable()->after('duration');
        });
    }

    public function down(): void
    {
        Schema::table('lab_requests', function (Blueprint $table) {
            $table->dropColumn(['approved_date', 'approved_time', 'duration', 'approved_at']);
        });
    }
};