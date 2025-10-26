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
        LabRequest::factory()->pending()->count(10)->create();

        
        LabRequest::factory()->approved()->count(15)->create();

        
        LabRequest::factory()->rejected()->count(5)->create();

        
        LabRequest::factory()->completed()->count(100)->create();

       
        LabRequest::factory()->cancelled()->count(3)->create();

        
        LabRequest::factory()->noShow()->count(2)->create();
    }
}
