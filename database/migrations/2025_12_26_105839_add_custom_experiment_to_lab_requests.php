// database/migrations/xxxx_xx_xx_add_custom_experiment_to_lab_requests.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('lab_requests', function (Blueprint $table) {
            $table->string('custom_experiment_name')->nullable()->after('experiment_id');
        });
    }

    public function down()
    {
        Schema::table('lab_requests', function (Blueprint $table) {
            $table->dropColumn('custom_experiment_name');
        });
    }
};