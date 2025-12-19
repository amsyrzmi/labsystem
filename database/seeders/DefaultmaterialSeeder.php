<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Defaultmaterial;

class DefaultmaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            ['name' => 'Distilled Water', 'quantity' => '150', 'unit' => 'cm³','experiment_id' => 1],
            ['name' => 'Salt', 'quantity' => '120', 'unit' => 'g','experiment_id' => 1],

            ['name' => 'Lithium', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Sodium', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Potassium', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Distilled Water', 'quantity' => '1000', 'unit' => 'cm³','experiment_id' => 2],
            ['name' => 'Filter Paper', 'quantity' => '9', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Red Litmus Paper', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Oxygen', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Chlorine', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],

            ['name' => 'Sodium Oxide', 'quantity' => '2', 'unit' => 'set','experiment_id' => 3],
            ['name' => 'Magnesium Oxide', 'quantity' => '2', 'unit' => 'set','experiment_id' => 3],
            ['name' => 'Aluminium Oxide', 'quantity' => '2', 'unit' => 'set','experiment_id' => 3],
            ['name' => 'Sulphur Dioxide', 'quantity' => '2', 'unit' => 'set','experiment_id' => 3],
            ['name' => 'Silicon Oxide', 'quantity' => '2', 'unit' => 'set','experiment_id' => 3],
            ['name' => 'Distilled Water', 'quantity' => '40', 'unit' => 'cm³','experiment_id' => 3],
            ['name' => 'Sodium Hydroxide', 'quantity' => '5', 'unit' => 'cm³','experiment_id' => 3,'concentration' => 2],
            ['name' => 'Nitric Acid', 'quantity' => '5', 'unit' => 'cm³','experiment_id' => 3,'concentration' => 2],
        ];
        foreach ($materials as $item) {
            Defaultmaterial::create($item);
        }

    }
}
