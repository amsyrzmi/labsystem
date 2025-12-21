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
            //?Chemistry Form 4 Experiment 1.1
            ['name' => 'Distilled Water', 'quantity' => '150', 'unit' => 'cm³','experiment_id' => 1],
            ['name' => 'Salt', 'quantity' => '120', 'unit' => 'g','experiment_id' => 1],

            //?Chemistry Form 4 Experiment 4.1
            ['name' => 'Lithium', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Sodium', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Potassium', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Distilled Water', 'quantity' => '1000', 'unit' => 'cm³','experiment_id' => 2],
            ['name' => 'Filter Paper', 'quantity' => '9', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Red Litmus Paper', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Oxygen', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],
            ['name' => 'Chlorine', 'quantity' => '3', 'unit' => 'set','experiment_id' => 2],

            //?Chemistry Form 4 Experiment 4.2
            ['name' => 'Sodium Oxide', 'quantity' => '2', 'unit' => 'set','experiment_id' => 3],
            ['name' => 'Magnesium Oxide', 'quantity' => '2', 'unit' => 'set','experiment_id' => 3],
            ['name' => 'Aluminium Oxide', 'quantity' => '2', 'unit' => 'set','experiment_id' => 3],
            ['name' => 'Sulphur Dioxide', 'quantity' => '2', 'unit' => 'set','experiment_id' => 3],
            ['name' => 'Silicon Oxide', 'quantity' => '2', 'unit' => 'set','experiment_id' => 3],
            ['name' => 'Distilled Water', 'quantity' => '40', 'unit' => 'cm³','experiment_id' => 3],
            ['name' => 'Sodium Hydroxide', 'quantity' => '5', 'unit' => 'cm³','experiment_id' => 3,'concentration' => 2],
            ['name' => 'Nitric Acid', 'quantity' => '5', 'unit' => 'cm³','experiment_id' => 3,'concentration' => 2],

            //?Chemistry Form 4 Experiment 5.1
            ['name' => 'Solid Lead(II) Chloride', 'quantity' => '2', 'unit' => 'set','experiment_id' => 4],
            ['name' => 'Naphthalene', 'quantity' => '5', 'unit' => 'set','experiment_id' => 4],
            ['name' => 'Solid Magnesium Chloride', 'quantity' => '2', 'unit' => 'set','experiment_id' => 4],
            ['name' => 'Cyclohexane', 'quantity' => '2', 'unit' => 'set','experiment_id' => 4],
            ['name' => 'Distilled Water', 'quantity' => '255', 'unit' => 'cm³','experiment_id' => 4],

            //?Chemistry Form 4 Experiment 6.1
            ['name' => 'Blue Litmus Paper', 'quantity' => '2', 'unit' => 'set','experiment_id' => 5],
            ['name' => 'Distilled Water', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 5],
            ['name' => 'Solid Oxalic Acid', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 5],

            //?Chemistry Form 4 Experiment 6.2
            ['name' => 'Solid Sodium Hydroxide', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 6,'concentration' => 2],
            ['name' => 'Red Litmus Paper', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 6,'concentration' => 2],
            ['name' => 'Distilled Water', 'quantity' => '200', 'unit' => 'cm³','experiment_id' => 6],

            //?Chemistry Form 4 Experiment 6.3
            ['name' => 'Hydrochloric Acid', 'quantity' => '20', 'unit' => 'cm³','experiment_id' => 7,'concentration' => 0.1],
            ['name' => 'Hydrochloric Acid', 'quantity' => '20', 'unit' => 'cm³','experiment_id' => 7,'concentration' => 0.01],
            ['name' => 'Hydrochloric Acid', 'quantity' => '20', 'unit' => 'cm³','experiment_id' => 7,'concentration' => 0.001],

            //?Chemistry Form 4 Experiment 6.4
            ['name' => 'Sodium Hydroxide', 'quantity' => '20', 'unit' => 'cm³','experiment_id' => 8,'concentration' => 0.1],
            ['name' => 'Sodium Hydroxide', 'quantity' => '20', 'unit' => 'cm³','experiment_id' => 8,'concentration' => 0.01],
            ['name' => 'Sodium Hydroxide', 'quantity' => '20', 'unit' => 'cm³','experiment_id' => 8,'concentration' => 0.001],

            //?Chemistry Form 4 Experiment 6.5
            ['name' => 'Nitrate Salt', 'quantity' => '1', 'unit' => 'set','experiment_id' => 9],
            ['name' => 'Sulphate Salt', 'quantity' => '1', 'unit' => 'set','experiment_id' => 9],
            ['name' => 'Chloride Salt', 'quantity' => '1', 'unit' => 'set','experiment_id' => 9],
            ['name' => 'Carbonate Salt', 'quantity' => '1', 'unit' => 'set','experiment_id' => 9],
            ['name' => 'Ammonium Salt', 'quantity' => '1', 'unit' => 'set','experiment_id' => 9],
            ['name' => 'Distilled Water', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 9],

            //?Chemistry Form 4 Experiment 6.6
            ['name' => 'Lead(II) Nitrate', 'quantity' => '40', 'unit' => 'cm³','experiment_id' => 10,'concentration' => 0.5],
            ['name' => 'Potassium Iodide', 'quantity' => '36', 'unit' => 'cm³','experiment_id' => 10,'concentration' => 0.5],
            ['name' => 'Distilled Water', 'quantity' => '160', 'unit' => 'cm³','experiment_id' => 10],

            //?Chemistry Form 4 Experiment 6.7
            ['name' => 'Solid Sodium Carbonate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 11],
            ['name' => 'Solid Calcium Carbonate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 11],
            ['name' => 'Solid Zinc Carbonate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 11],
            ['name' => 'Solid Lead(II) Carbonate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 11],
            ['name' => 'Solid Copper(II) Carbonate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 11],
            ['name' => 'Limewater', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 11],

            //?Chemistry Form 4 Experiment 6.8
            ['name' => 'Solid Sodium Nitrate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 12],
            ['name' => 'Solid Magnesium Nitrate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 12],
            ['name' => 'Solid Zinc Nitrate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 12],
            ['name' => 'Solid Lead(II) Nitrate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 12],
            ['name' => 'Solid Copper(II) Chloride', 'quantity' => '1', 'unit' => 'set','experiment_id' => 12],
            ['name' => 'Wooden Splinter', 'quantity' => '1', 'unit' => 'set','experiment_id' => 12],
            ['name' => 'Blue Litmus Paper', 'quantity' => '5', 'unit' => 'set','experiment_id' => 12],

            //?Chemistry Form 4 Experiment 6.9
            ['name' => 'Nitric Acid', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 13,'concentration' => 2],
            ['name' => 'Hydrochloric Acid', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 13,'concentration' => 2],
            ['name' => 'Silver Nitrate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 13,'concentration' => 0.1],
            ['name' => 'Barium Chloride', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 13,'concentration' => 1],
            ['name' => 'Sulphuric Acid', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 13,'concentration' => 1],
            ['name' => 'Iron(II) Sulphate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 13,'concentration' => 1],
            ['name' => 'Concentrated Sulphuric Acid', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 13],
            ['name' => 'Solid Sodium Carbonate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 13],
            ['name' => 'Solid Sodium Chloride', 'quantity' => '1', 'unit' => 'set','experiment_id' => 13],
            ['name' => 'Solid Sodium Sulphate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 13],
            ['name' => 'Solid Sodium Nitrate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 13],
            ['name' => 'Distilled Water', 'quantity' => '80', 'unit' => 'cm³','experiment_id' => 13],
            ['name' => 'Limewater', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 13],

            //?Chemistry Form 4 Experiment 6.10
            ['name' => 'Sodium Hydroxide', 'quantity' => '20', 'unit' => 'cm³','experiment_id' => 14,'concentration' => 2],
            ['name' => 'Ammonia', 'quantity' => '20', 'unit' => 'cm³','experiment_id' => 14,'concentration' => 2],
            ['name' => 'Calcium Nitrate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 14,'concentration' => 1],
            ['name' => 'Magnesium Nitrate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 14,'concentration' => 1],
            ['name' => 'Aluminium Nitrate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 14,'concentration' => 1],
            ['name' => 'Zinc Nitrate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 14,'concentration' => 1],
            ['name' => 'Iron(II) Sulphate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 14,'concentration' => 1],
            ['name' => 'Iron(III) Chloride', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 14,'concentration' => 1],
            ['name' => 'Lead(II) Nitrate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 14,'concentration' => 1],
            ['name' => 'Copper(II) Sulphate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 14,'concentration' => 1],
            ['name' => 'Ammonium Nitrate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 14,'concentration' => 1],


            //?Chemistry Form 4 Experiment 6.11
            ['name' => 'Ammonium Chloride', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 15,'concentration' => 1],
            ['name' => 'Nessler Reagent', 'quantity' => '1', 'unit' => 'cm³','experiment_id' => 15],
            ['name' => 'Iron(II) Sulphate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 15,'concentration' => 1],
            ['name' => 'Iron(III) Chloride', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 15,'concentration' => 1],
            ['name' => 'Potassium Hexacyanoferrate(III)', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 15,'concentration' => 1],
            ['name' => 'Lead(II) Nitrate', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 15,'concentration' => 1],
            ['name' => 'Potassium Iodide', 'quantity' => '1', 'unit' => 'cm³','experiment_id' => 15,'concentration' => 1],
            ['name' => 'Distilled Water', 'quantity' => '3', 'unit' => 'cm³','experiment_id' => 15],

            //?Chemistry Form 4 Experiment 7.1
            ['name' => 'Hydrochloric Acid', 'quantity' => '160', 'unit' => 'cm³','experiment_id' => 16,'concentration' => 0.1],
            ['name' => 'Large Marble Chip', 'quantity' => '5', 'unit' => 'g','experiment_id' => 16],
            ['name' => 'Small Marble Chip', 'quantity' => '5', 'unit' => 'g','experiment_id' => 16],
            ['name' => 'Distilled Water', 'quantity' => '500', 'unit' => 'cm³','experiment_id' => 16],

            //?Chemistry Form 4 Experiment 7.2
            ['name' => 'Sulphuric Acid', 'quantity' => '25', 'unit' => 'cm³','experiment_id' => 17,'concentration' => 1],
            ['name' => 'Sodium Thiosulphate', 'quantity' => '145', 'unit' => 'cm³','experiment_id' => 17,'concentration' => 0.2],
            ['name' => 'Distilled Water', 'quantity' => '80', 'unit' => 'cm³','experiment_id' => 17],
            ['name' => 'White Piece of Paper', 'quantity' => '5', 'unit' => 'set','experiment_id' => 17],

            //?Chemistry Form 4 Experiment 7.3
            ['name' => 'Sulphuric Acid', 'quantity' => '25', 'unit' => 'cm³','experiment_id' => 18,'concentration' => 1],
            ['name' => 'Sodium Thiosulphate', 'quantity' => '145', 'unit' => 'cm³','experiment_id' => 18,'concentration' => 0.2],
            ['name' => 'Distilled Water', 'quantity' => '80', 'unit' => 'cm³','experiment_id' => 18],
            ['name' => 'White Piece of Paper', 'quantity' => '5', 'unit' => 'set','experiment_id' => 18],

            //?Chemistry Form 4 Experiment 7.4
            ['name' => '20-Volume Hydrogen Peroxide', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 19,'concentration' => 0.1],
            ['name' => 'Solid Manganese(IV) Oxide', 'quantity' => '0.5', 'unit' => 'g','experiment_id' => 19],
            ['name' => 'Distilled Water', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 19],

            //?Chemistry Form 4 Experiment 8.1
            ['name' => 'Stainless Steel Plate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 20],
            ['name' => 'Iron Plate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 20],
            ['name' => 'Bronze Block', 'quantity' => '1', 'unit' => 'set','experiment_id' => 20],
            ['name' => 'Copper Block', 'quantity' => '1', 'unit' => 'set','experiment_id' => 20],
            ['name' => 'Distilled Water', 'quantity' => '160', 'unit' => 'cm³','experiment_id' => 20],
            


        ];
        foreach ($materials as $item) {
            Defaultmaterial::create($item);
        }

    }
}
