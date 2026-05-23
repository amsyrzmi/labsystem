<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LabRequest;

class LabRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LabRequest::factory()->pending()->count(20)->create();

        
        LabRequest::factory()->approved()->count(20)->create();

        
        LabRequest::factory()->rejected()->count(20)->create();

        
        LabRequest::factory()->completed()->count(20)->create();
    }
}
