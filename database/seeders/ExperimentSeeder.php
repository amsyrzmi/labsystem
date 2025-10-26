<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Experiment;

class ExperimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chemistryf4 = [
            ['name' => 'Experiment 1.1 Temperature Effects on Solubility', 'topic_id' => 1],
            ['name' => 'Experiment 4.1 Chemical properties of Group 1', 'topic_id' => 4],
            ['name' => 'Experiment 4.2 Chemical properties of oxides of Period 3', 'topic_id' => 4],
        ];
        foreach ($chemistryf4 as $experiment) {
            Experiment::create($experiment);
        }
    }
}
