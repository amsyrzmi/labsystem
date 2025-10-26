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
            
        ];
        foreach ($apparatus as $item) {
            Defaultapparatus::create($item);
        }
    }
}
