<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Defaultapparatus;

class DefaultApparatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apparatus = [
            ['name' => '150 cm³ Beaker', 'quantity' => '1','experiment_id' => 1],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Electronic Scale', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Glass Rod', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 1],


            ['name' => 'Forceps', 'quantity' => '1','experiment_id' => 2],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'White Tile', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'Basin', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'Knife', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'Combustion Spoon', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'Gas Jar with Lid', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 2],


            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'Test Tube', 'quantity' => '14','experiment_id' => 3],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'Stopper', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'pH Meter', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'Glass rod', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 3],


        ];
        foreach ($apparatus as $item) {
            Defaultapparatus::create($item);
        }
    }
}
