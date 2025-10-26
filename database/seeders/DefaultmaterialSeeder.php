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
        ];
        foreach ($materials as $item) {
            Defaultmaterial::create($item);
        }

    }
}
