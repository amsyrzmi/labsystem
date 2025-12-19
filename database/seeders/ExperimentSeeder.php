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
            ['name' => 'Experiment 5.1 Properties of Ionic and Covalent Compounds', 'topic_id' => 5],
            ['name' => 'Experiment 6.1 Role of Water in Showing Acidic properties', 'topic_id' => 6],
            ['name' => 'Experiment 6.2 Role of Water in Showing Alkaline properties', 'topic_id' => 6],
            ['name' => 'Experiment 6.3 Hydrogen Ions and pH values', 'topic_id' => 6],
            ['name' => 'Experiment 6.4 Hydroxide Ions and pH values', 'topic_id' => 6],
            ['name' => 'Experiment 6.5 Solubility of Various Salts in Water', 'topic_id' => 6],
            ['name' => 'Experiment 6.6 Ionic Quation For Formation of Lead(II) Iodide', 'topic_id' => 6],
            ['name' => 'Experiment 6.7 Action of Heat on Carbonate Salts', 'topic_id' => 6],
            ['name' => 'Experiment 6.8 Action of Heat on Nitrate Salts', 'topic_id' => 6],
            ['name' => 'Experiment 6.9 Identification of Anions in Aqueous Solutions', 'topic_id' => 6],
            ['name' => 'Experiment 6.10 Identification of Cations in Aqueous Solutions', 'topic_id' => 6],
            ['name' => 'Experiment 6.11 Cations confirmation test(NH₄⁺,Fe³⁺,Fe²⁺ and Pb²⁺)', 'topic_id' => 6],
            ['name' => 'Experiment 7.1 Size of Reactants on Rate of Reaction', 'topic_id' => 7],
            ['name' => 'Experiment 7.2 Concentration of Reactants on Rate of Reaction', 'topic_id' => 7],
            ['name' => 'Experiment 7.3 Temperature of Reactants on Rate of Reaction', 'topic_id' => 7],
            ['name' => 'Experiment 7.4 Catalyst on Rate of Reaction', 'topic_id' => 7],
            ['name' => 'Experiment 8.1 Properties of Alloys and Pure Metals', 'topic_id' => 8],


        ];
        foreach ($chemistryf4 as $experiment) {
            Experiment::create($experiment);
        }
    }
}
