<?php

namespace Database\Seeders;

use App\Models\defaultmaterial;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin',
        ]);
        $this->call(UserSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(TopicSeeder::class);
        $this->call(ExperimentSeeder::class);
        $this->call(defaultmaterialSeeder::class);
        $this->call(defaultapparatusSeeder::class);
        $this->call(LabrequestSeeder::class);
    }
}
