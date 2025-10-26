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
        Schema::create('lab_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // who requested (teacher)
            $table->string('form_level');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->unsignedBigInteger('experiment_id')->nullable();
            $table->unsignedInteger('num_students');
            $table->unsignedInteger('group_size');
            $table->string('classname');
            $table->string('lab_number');
            $table->unsignedInteger('repetition');
            $table->date('preferred_date');
            $table->time('preferred_time');
            $table->text('additional_notes')->nullable();
            $table->string('status')->default('pending');

            
            $table->timestamp('completed_at')->nullable(); // When session happened
            $table->text('rejection_reason')->nullable(); // Why rejected

            $table->timestamps();


            // Foreign keys 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('set null');
            $table->foreign('experiment_id')->references('id')->on('experiments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_requests');
    }
};
