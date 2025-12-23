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
            
            //!Physics Form 4 Experiment 1.1
            ['name' => '100 cm Thread', 'quantity' => '1', 'unit' => 'set','experiment_id' => 21],
            ['name' => 'Small Piece of Plywood', 'quantity' => '1', 'unit' => 'set','experiment_id' => 21],

            //!Physics Form 4 Experiment 2.1
            //!None

            //!Physics Form 4 Experiment 2.2
            ['name' => 'Plasticine', 'quantity' => '20', 'unit' => 'g','experiment_id' => 23],
            ['name' => 'Plasticine', 'quantity' => '30', 'unit' => 'g','experiment_id' => 23],
            ['name' => 'Plasticine', 'quantity' => '40', 'unit' => 'g','experiment_id' => 23],
            ['name' => 'Plasticine', 'quantity' => '50', 'unit' => 'g','experiment_id' => 23],
            ['name' => 'Plasticine', 'quantity' => '60', 'unit' => 'g','experiment_id' => 23],

            //!Physics Form 4 Experiment 4.1
            ['name' => 'Plasticine', 'quantity' => '1', 'unit' => 'set','experiment_id' => 24],
            ['name' => 'Tissue', 'quantity' => '1', 'unit' => 'set','experiment_id' => 24],

            //!Physics Form 4 Experiment 4.2
            ['name' => 'Tissue', 'quantity' => '1', 'unit' => 'set','experiment_id' => 25],

            //!Physics Form 4 Experiment 4.3
            ['name' => 'Crushed Ice', 'quantity' => '1', 'unit' => 'set','experiment_id' => 26],
            ['name' => 'Distilled Water', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 26],
            ['name' => 'Tissue', 'quantity' => '1', 'unit' => 'set','experiment_id' => 26],

            //!Physics Form 4 Experiment 4.4
            //!None

            //!Physics Form 4 Experiment 4.5
            ['name' => 'Distilled Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 28],
            ['name' => 'Ice', 'quantity' => '1', 'unit' => 'set','experiment_id' => 28],
            ['name' => 'Rubber Band', 'quantity' => '1', 'unit' => 'set','experiment_id' => 28],

            //!Physics Form 4 Experiment 4.6
            ['name' => 'Distilled Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 29],
            ['name' => 'Ice', 'quantity' => '1', 'unit' => 'set','experiment_id' => 29],

            //!Physics Form 4 Experiment 6.1
            ['name' => 'Glass Block', 'quantity' => '1', 'unit' => 'set','experiment_id' => 30],
            ['name' => 'White Paper', 'quantity' => '1', 'unit' => 'set','experiment_id' => 30],
            ['name' => 'Pencil', 'quantity' => '1', 'unit' => 'set','experiment_id' => 30],

            //!Physics Form 4 Experiment 6.2
            ['name' => 'Cork', 'quantity' => '1', 'unit' => 'set','experiment_id' => 31],
            ['name' => 'Pin', 'quantity' => '2', 'unit' => 'set','experiment_id' => 31],
            ['name' => 'Cellophane Tape', 'quantity' => '1', 'unit' => 'set','experiment_id' => 31],
            ['name' => 'Distilled Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 31],

            //?Chemistry Form 5 Experiment 1A
            ['name' => 'Magnesium Plate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 32],
            ['name' => 'Copper Plate', 'quantity' => '3', 'unit' => 'set','experiment_id' => 32],
            ['name' => 'Iron Plate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 32],
            ['name' => 'Zinc Plate', 'quantity' => '1', 'unit' => 'set','experiment_id' => 32],
            ['name' => 'Zinc Sulphate', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 32,'concentration'=> 1],
            ['name' => 'Copper(II) Sulphate', 'quantity' => '150', 'unit' => 'cm³','experiment_id' => 32,'concentration'=> 1],
            ['name' => 'Iron(II) Sulphate', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 32,'concentration'=> 1],
            ['name' => 'Magnesium Sulphate', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 32,'concentration'=> 1],

            //?Chemistry Form 5 Experiment 1B
            ['name' => 'Hydrochloric Acid', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 33,'concentration'=> 1],
            ['name' => 'Hydrochloric Acid', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 33,'concentration'=> 0.0001],
            ['name' => 'Wooden Splinter', 'quantity' => '1','unit' => 'set','experiment_id' => 33],
            ['name' => 'Blue Litmus Paper', 'quantity' => '8','unit' => 'set','experiment_id' => 33],

            //?Chemistry Form 5 Experiment 1C
            ['name' => 'Copper(II) Sulphate', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 34,'concentration'=> 0.5],
            ['name' => 'Wooden Splinter', 'quantity' => '1', 'unit' => 'set','experiment_id' => 34],

            //?Chemistry Form 5 Experiment 1D
            ['name' => 'Copper Wire', 'quantity' => '20', 'unit' => 'cm','experiment_id' => 35],
            ['name' => 'Iron Wire', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 35],
            ['name' => 'Sodium Chloride', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 35,'concentration'=> 0.5],
            ['name' => 'Potassium Chloride', 'quantity' => '1', 'unit' => 'set','experiment_id' => 35,'concentration'=> 0.5],
            ['name' => 'Sodium Hydroxide', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 35,'concentration'=> 0.5],
            //?Chemistry Form 5 Experiment 1E
            ['name' => 'Agar Solution', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 36],
            ['name' => 'Phenolphthalein', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 36],
            ['name' => 'Potassium Hexacyanoferrate(III)', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 36,'concentration'=> 0.5],
            ['name' => 'Iron Nail', 'quantity' => '1', 'unit' => 'set','experiment_id' => 36],
            ['name' => 'Magnesium Ribbon', 'quantity' => '1', 'unit' => 'set','experiment_id' => 36],
            ['name' => 'Tin Strip', 'quantity' => '1', 'unit' => 'set','experiment_id' => 36],
            ['name' => 'Copper Strip', 'quantity' => '1', 'unit' => 'set','experiment_id' => 36],

            //?Chemistry Form 5 Experiment 2A
            ['name' => 'Hexane', 'quantity' => '6', 'unit' => 'cm³','experiment_id' => 37],
            ['name' => 'Hexene', 'quantity' => '6', 'unit' => 'set','experiment_id' => 37],
            ['name' => 'Wooden Splinter', 'quantity' => '1', 'unit' => 'set','experiment_id' => 37],
            ['name' => 'Matches', 'quantity' => '1', 'unit' => 'set','experiment_id' => 37],
            ['name' => 'Filter Paper', 'quantity' => '1', 'unit' => 'set','experiment_id' => 37],
            ['name' => 'Bromine Water', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 37],
            ['name' => '1,1,1-Trichloroethane', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 37],
            ['name' => 'Potassium Manganate', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 37,'concentration'=> 0.1],

            //?Chemistry Form 5 Experiment 3A
            ['name' => 'Hydrochloric Acid', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 38,'concentration'=> 1],
            ['name' => 'Ethanoic Acid', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 38,'concentration'=> 1],
            ['name' => 'Sodium Hydroxide', 'quantity' => '100', 'unit' => 'g','experiment_id' => 38,'concentration'=> 1],

            //?Chemistry Form 5 Experiment 3B
            ['name' => 'Methanol', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 39],
            ['name' => 'Ethanol', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 39],
            ['name' => 'Propanol', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 39],
            ['name' => 'Distilled Water', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 39,'concentration'=> 1],

            //?Chemistry Form 5 Experiment 4A
            ['name' => 'Latex', 'quantity' => '40', 'unit' => 'cm³','experiment_id' => 40],
            ['name' => 'Ethanoic Acid', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 40,'concentration'=> 1],
            ['name' => 'Ammonia', 'quantity' => '2', 'unit' => 'cm³','experiment_id' => 40,'concentration'=> 1],

            //?Chemistry Form 5 Experiment 4B
            ['name' => 'Vulcanised Rubber Strip', 'quantity' => '1', 'unit' => 'set','experiment_id' => 41],
            ['name' => 'Unvulcanised Rubber Strip', 'quantity' => '1', 'unit' => 'set','experiment_id' => 41],

            //?Chemistry Form 5 Experiment 5A
            ['name' => 'Hard Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 42],
            ['name' => 'Soap', 'quantity' => '1', 'unit' => 'set','experiment_id' => 42],
            ['name' => 'Detergent', 'quantity' => '1', 'unit' => 'set','experiment_id' => 42],
            ['name' => 'Stained Cloth', 'quantity' => '1', 'unit' => 'set','experiment_id' => 42],

            //!Physics Form 5 Experiment 1.1
            ['name' => 'Pin', 'quantity' => '1', 'unit' => 'set','experiment_id' => 94],
            ['name' => 'Plasticine', 'quantity' => '200', 'unit' => 'g','experiment_id' => 94],
            ['name' => 'Thread', 'quantity' => '1', 'unit' => 'set','experiment_id' => 94],

            //!Physics Form 5 Experiment 2.1
            ['name' => 'Distilled Water', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 95],
            ['name' => 'Food Coloring', 'quantity' => '1', 'unit' => 'set','experiment_id' => 95],

            //!Physics Form 5 Experiment 2.2
            ['name' => 'Masking Tape', 'quantity' => '1', 'unit' => 'set','experiment_id' => 96],
            ['name' => 'Distilled Water', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 96],
            ['name' => 'Alcohol', 'quantity' => '1', 'unit' => 'set','experiment_id' => 96],
            ['name' => 'Glycerine', 'quantity' => '1', 'unit' => 'set','experiment_id' => 96],

            //!Physics Form 5 Experiment 2.3
            ['name' => 'Distilled Water', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 97],

            //!Physics Form 5 Experiment 3.1
            ['name' => 's.w.g.24 Constantan Wire', 'quantity' => '20','unit' => 'cm','experiment_id' => 98],

            //!Physics Form 5 Experiment 3.2
            ['name' => 's.w.g.24 Constantan Wire', 'quantity' => '110','unit' => 'cm','experiment_id' => 99],

            //!Physics Form 5 Experiment 3.3
            ['name' => 's.w.g.22 Constantan Wire', 'quantity' => '30','unit' => 'cm','experiment_id' => 100],
            ['name' => 's.w.g.24 Constantan Wire', 'quantity' => '30','unit' => 'cm','experiment_id' => 100],
            ['name' => 's.w.g.26 Constantan Wire', 'quantity' => '30','unit' => 'cm','experiment_id' => 100],
            ['name' => 's.w.g.28 Constantan Wire', 'quantity' => '30','unit' => 'cm','experiment_id' => 100],
            ['name' => 's.w.g.30 Constantan Wire', 'quantity' => '30','unit' => 'cm','experiment_id' => 100],
            //!Physics Form 5 Experiment 3.4
            ['name' => 's.w.g.24 Constantan Wire', 'quantity' => '35','unit' => 'cm','experiment_id' => 101],
            ['name' => 's.w.g.24 Nichrome Wire', 'quantity' => '35','unit' => 'cm','experiment_id' => 101],

            //!Physics Form 5 Experiment 3.5
            //!None

            //*Science Form 4 Experiment 3.1
            //*None

            //*Science Form 4 Experiment  9.1
            ['name' => 'Copper Block', 'quantity' => '1', 'unit' => 'set','experiment_id' => 44],
            ['name' => 'Bronze Block', 'quantity' => '1', 'unit' => 'set','experiment_id' => 44],
            ['name' => 'Cellophane Tape', 'quantity' => '1', 'unit' => 'set','experiment_id' => 44],
            ['name' => 'Thread', 'quantity' => '100', 'unit' => 'cm','experiment_id' => 44],

            //*Science Form 4 Experiment 9.2
            ['name' => 'Iron Nail', 'quantity' => '1', 'unit' => 'set','experiment_id' => 45],
            ['name' => 'Steel Nail', 'quantity' => '1', 'unit' => 'set','experiment_id' => 45],
            ['name' => 'Distilled Water', 'quantity' => '20', 'unit' => 'cm³','experiment_id' => 45],

            //*Science Form 4 Experiment 11.1
            ['name' => 'Ticker Tape', 'quantity' => '1', 'unit' => 'set','experiment_id' => 46],
            ['name' => 'Cellophane Tape', 'quantity' => '1', 'unit' => 'set','experiment_id' => 46],

            //*Science Form 4 Experiment 11.2
            ['name' => 'Cylinder Tube', 'quantity' => '1', 'unit' => 'set','experiment_id' => 47],
            ['name' => 'Rubber Stopper', 'quantity' => '1', 'unit' => 'set','experiment_id' => 47],
            ['name' => 'Vacuum Pump', 'quantity' => '1', 'unit' => 'set','experiment_id' => 47],

            //*Science Form 5 Experiment 11.3
            ['name' => 'Plasticine', 'quantity' => '1', 'unit' => 'set','experiment_id' => 48],




            //*Science Form 5 Experiment 1.1
            ['name' => 'Sterile Nutirnt Agar', 'quantity' => '1', 'unit' => 'set','experiment_id' => 49],
            ['name' => 'Cellophane Tape', 'quantity' => '1', 'unit' => 'set','experiment_id' => 49],
            ['name' => 'Marker Pen', 'quantity' => '1', 'unit' => 'set','experiment_id' => 49],

            //*Science Form 5 Experiment 1.2
            ['name' => 'Bacillus sp. Culture Solution', 'quantity' => '5', 'unit' => 'set','experiment_id' => 50],
            ['name' => 'Sterile Nutrient Agar', 'quantity' => '3', 'unit' => 'set','experiment_id' => 50],
            ['name' => 'Sterile Non-Nutrient Agar', 'quantity' => '1', 'unit' => 'set','experiment_id' => 50],
            ['name' => 'Moist Sterile Nutrient Agar', 'quantity' => '2', 'unit' => 'set','experiment_id' => 50],
            ['name' => 'Cellophane Tape', 'quantity' => '1', 'unit' => 'set','experiment_id' => 50],
            ['name' => 'Marker Pen', 'quantity' => '1', 'unit' => 'set','experiment_id' => 50],
            ['name' => 'Sulphuric Acid', 'quantity' => '1', 'unit' => 'cm³','experiment_id' => 50,'concentration' => 0.05],
            ['name' => 'Sodium Hydroxide', 'quantity' => '1', 'unit' => 'cm³','experiment_id' => 50,'concentration' => 0.05],
            ['name' => 'Distilled Water', 'quantity' => '1', 'unit' => 'cm³','experiment_id' => 50],

            //*Science Form 5 Experiment 2.1
            ['name' => 'Groundnut', 'quantity' => '1', 'unit' => 'g','experiment_id' => 51],
            ['name' => 'Bread', 'quantity' => '1', 'unit' => 'g','experiment_id' => 51],
            ['name' => 'Anchovie', 'quantity' => '1', 'unit' => 'g','experiment_id' => 51],
            ['name' => 'Cotton Wool', 'quantity' => '1', 'unit' => 'g','experiment_id' => 51],
            ['name' => 'Distilled Water', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 51],

            //*Science Form 5 Experiment 2.2
            ['name' => 'Distilled Water', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 52],
            ['name' => 'Culture Solution without Nitrogen', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 52],
            ['name' => 'Culture Solution without Phosphorus', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 52],
            ['name' => 'Culture Solution without potassium', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 52],
            ['name' => 'Bean Seedlings', 'quantity' => '4', 'unit' => 'set','experiment_id' => 52],
            ['name' => 'Black Paper', 'quantity' => '4', 'unit' => 'set','experiment_id' => 52],
            ['name' => 'Cotton Wool', 'quantity' => '4', 'unit' => 'set','experiment_id' => 52],

            //*Science Form 5 Experiment 4.1
            ['name' => 'Sodium Thiosulphate', 'quantity' => '250', 'unit' => 'cm³','experiment_id' => 53,'concentration' => 0.2],
            ['name' => 'Sulphuric Acid', 'quantity' => '25', 'unit' => 'cm³','experiment_id' => 53,'concentration' => 1],
            ['name' => 'White Piece of Paper', 'quantity' => '4', 'unit' => 'set','experiment_id' => 53],

            //*Science Form 5 Experiment 4.2
            ['name' => 'Sodium Thiosulphate', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 54,'concentration' => 0.2],
            ['name' => 'Sodium Thiosulphate', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 54,'concentration' => 0.16],
            ['name' => 'Sodium Thiosulphate', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 54,'concentration' => 0.12],
            ['name' => 'Sodium Thiosulphate', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 54,'concentration' => 0.08],
            ['name' => 'Sodium Thiosulphate', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 54,'concentration' => 0.04],
            ['name' => 'Sulphuric Acid', 'quantity' => '25', 'unit' => 'cm³','experiment_id' => 54,'concentration' => 1],
            ['name' => 'White Piece of Paper', 'quantity' => '4', 'unit' => 'set','experiment_id' => 54],
            ['name' => 'Distilled Water', 'quantity' => '20', 'unit' => 'g','experiment_id' => 54],

            //*Science Form 5 Experiment 4.3
            ['name' => 'Small Marble Chip', 'quantity' => '1', 'unit' => 'set','experiment_id' => 55],
            ['name' => 'Big Marble Chip', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 55],
            ['name' => 'Hydrochloric Acid', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 55,'concentration' => 0.1],
            ['name' => 'Limewater', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 55],

            //*Science Form 5 Experiment 4.4
            ['name' => 'Small Piece of Zinc', 'quantity' => '4', 'unit' => 'g','experiment_id' => 56],
            ['name' => 'Hydrochloric Acid', 'quantity' => '5', 'unit' => 'cm³','experiment_id' => 56,'concentration' => 0.1],
            ['name' => 'Copper(II) Sulphate', 'quantity' => '80', 'unit' => 'cm³','experiment_id' => 56,'concentration' => 0.5],

            //*Science Form 5 Experiment 5.1
            ['name' => 'Palm Oil', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 57],
            ['name' => 'Sodium Hydroxide', 'quantity' => '50', 'unit' => 'cm³','experiment_id' => 57,'concentration' => 0.1],
            ['name' => 'Sodium Chloride', 'quantity' => '5', 'unit' => 'g','experiment_id' => 57,'concentration' => 0.1],
            ['name' => 'Filter Paper', 'quantity' => '1', 'unit' => 'set','experiment_id' => 57],
            ['name' => 'Red Litmus Paper', 'quantity' => '5', 'unit' => 'set','experiment_id' => 57],
            ['name' => 'Blue Litmus Paper', 'quantity' => '5', 'unit' => 'set','experiment_id' => 57],

            //*Science Form 5 Experiment 6.1
            ['name' => 'Solid Lead(II) Bromide', 'quantity' => '2', 'unit' => 'set','experiment_id' => 58],
            ['name' => 'Copper(II) Sulphate', 'quantity' => '150', 'unit' => 'cm³','experiment_id' => 58,'concentration' => 0.1],

            //*Science Form 5 Experiment 6.2
            ['name' => 'Magnesium Nitrate', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 59,'concentration'=>0.5],
            ['name' => 'Sodium Sulphate', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 59,'concentration'=>0.5],
            ['name' => 'Wooden Splinter', 'quantity' => '1', 'unit' => 'set','experiment_id' => 59],

            //*Science Form 5 Experiment 6.3
            ['name' => 'Hydrochloric Acid', 'quantity' => '150', 'unit' => 'cm³','experiment_id' => 60,'concentration'=>1.0],
            ['name' => 'Hydrochloric Acid', 'quantity' => '150', 'unit' => 'cm³','experiment_id' => 60,'concentration'=>0.0001],
            ['name' => 'Wooden Splinter', 'quantity' => '2', 'unit' => 'set','experiment_id' => 60],

            //*Science Form 5 Experiment 6.4
            ['name' => 'Copper(II) Sulphate', 'quantity' => '150', 'unit' => 'cm³','experiment_id' => 61,'concentration' => 0.1],
            ['name' => 'Wooden Splinter', 'quantity' => '1', 'unit' => 'set','experiment_id' => 61],


            //*Science Form 2 Experiment 2.1
            ['name' => 'Woodlice', 'quantity' => '2','unit' => 'set','experiment_id' => 74],
            ['name' => 'Hot Water', 'quantity' => '1','unit' => 'set','experiment_id' => 74],

            //*Science Form 2 Experiment 3.1
            ['name' => '1% Starch Suspension', 'quantity' => '10','unit' => 'cm³','experiment_id' => 75],
            ['name' => 'Glucose Solution', 'quantity' => '10','unit' => 'cm³','experiment_id' => 75],
            ['name' => 'Visking Tube', 'quantity' => '4','unit' => 'set','experiment_id' => 75],
            ['name' => 'Iodine Solution', 'quantity' => '10','unit' => 'cm³','experiment_id' => 75],
            ['name' => 'Distilled Water', 'quantity' => '100','unit' => 'cm³','experiment_id' => 75],
            ['name' => 'Benedict\'s Solution', 'quantity' => '10','unit' => 'cm³','experiment_id' => 75],

            //*Science Form 2 Experiment 5.1
            ['name' => 'Anhydrous Cobalt Chloride Paper', 'quantity' => '3','unit' => 'set','experiment_id' => 76],
            ['name' => 'Water', 'quantity' => '150','unit' => 'cm³','experiment_id' => 76],
            ['name' => 'Thread', 'quantity' => '1','unit' => 'set','experiment_id' => 76],
            ['name' => 'Anhydrous Calcium Chloride', 'quantity' => '1','unit' => 'set','experiment_id' => 76],
            ['name' => 'Filter Paper', 'quantity' => '1','unit' => 'set','experiment_id' => 76],
            ['name' => 'Thread', 'quantity' => '1','unit' => 'set','experiment_id' => 76],
            ['name' => 'Cellophane Tape', 'quantity' => '1','unit' => 'set','experiment_id' => 76],

            //*Science Form 2 Experiment 5.2
            ['name' => 'Distilled Water', 'quantity' => '100','unit' => 'cm³','experiment_id' => 77],
            ['name' => 'Table Salt', 'quantity' => '2','unit' => 'set','experiment_id' => 77],
            ['name' => 'Sugar', 'quantity' => '2','unit' => 'set','experiment_id' => 77],
            ['name' => 'Sugar Cube', 'quantity' => '50','unit' => 'cm³','experiment_id' => 77],

            //*Science Form 2 Experiment 7.1
            ['name' => 'Nichrome Wire', 'quantity' => '60','unit' => 'cm','experiment_id' => 78],
            ['name' => 'Nichrome Wire', 'quantity' => '10','unit' => 'cm','experiment_id' => 78],
            ['name' => 'Thumbstack', 'quantity' => '1','unit' => 'set','experiment_id' => 78],
            ['name' => 'Crocodile Clip', 'quantity' => '2','unit' => 'set','experiment_id' => 78],
            ['name' => 'Jockey', 'quantity' => '1','unit' => 'set','experiment_id' => 78],
            ['name' => 'Connecting Wire', 'quantity' => '1','unit' => 'set','experiment_id' => 78],

            //*Science Form 2 Experiment 7.2
            ['name' => 'Pin', 'quantity' => '60','unit' => 'cm','experiment_id' => 79],
            ['name' => 'Iron Rod', 'quantity' => '10','unit' => 'cm','experiment_id' => 79],
            ['name' => 'Copper Wire', 'quantity' => '1','unit' => 'set','experiment_id' => 79],
            
            //*Science Form 2 Experiment 8.1
            ['name' => 'Copper Block', 'quantity' => '1', 'unit' => 'set','experiment_id' => 80],
            ['name' => 'Aluminium Block', 'quantity' => '1', 'unit' => 'set','experiment_id' => 80],
            ['name' => 'Wooden Block', 'quantity' => '1', 'unit' => 'set','experiment_id' => 80],

            //*Science Form 2 Experiment 8.2
            ['name' => 'Metal Block', 'quantity' => '1', 'unit' => 'set','experiment_id' => 82],
            ['name' => 'Plasticine', 'quantity' => '1', 'unit' => 'set','experiment_id' => 82],

            //*Science Form 2 Experiment 9.1
            ['name' => 'Cotton', 'quantity' => '1', 'unit' => 'set','experiment_id' => 83],
            ['name' => 'Felt', 'quantity' => '1', 'unit' => 'set','experiment_id' => 83],
            ['name' => 'Aluminium Foil', 'quantity' => '1', 'unit' => 'set','experiment_id' => 83],
            ['name' => 'Boiling Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 83],

            //*Science Form 2 Experiment 9.2
            ['name' => 'Black Paint', 'quantity' => '2', 'unit' => 'set','experiment_id' => 83],
            ['name' => 'White Paint', 'quantity' => '2', 'unit' => 'set','experiment_id' => 83],
            ['name' => 'Wooden Block', 'quantity' => '2', 'unit' => 'set','experiment_id' => 83],
            ['name' => 'Empty Milk Can', 'quantity' => '2', 'unit' => 'set','experiment_id' => 83],
            ['name' => 'Iron Plate', 'quantity' => '2', 'unit' => 'set','experiment_id' => 83],
            ['name' => 'Stopwatch', 'quantity' => '1', 'unit' => 'set','experiment_id' => 83],
            ['name' => 'Tripod Stand', 'quantity' => '1', 'unit' => 'set','experiment_id' => 83],
            ['name' => 'Wire Gauze', 'quantity' => '1', 'unit' => 'set','experiment_id' => 83],
            ['name' => 'Hot Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 83],



            //*Science Form 3 Experiment 1.1
            ['name' => 'Candle', 'quantity' => '200', 'unit' => 'cm³','experiment_id' => 84],
            ['name' => 'Plasticine', 'quantity' => '1', 'unit' => 'set','experiment_id' => 84],
            ['name' => 'Match', 'quantity' => '1', 'unit' => 'set','experiment_id' => 84],
            ['name' => 'Permanent Marker', 'quantity' => '1', 'unit' => 'set','experiment_id' => 84],
            ['name' => 'Distilled Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 84],
            ['name' => 'Lime Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 84],


            //*Science Form 3 Experiment 2.1
            ['name' => 'Candle', 'quantity' => '200', 'unit' => 'cm³','experiment_id' => 85],
            ['name' => 'Plasticine', 'quantity' => '1', 'unit' => 'set','experiment_id' => 85],
            ['name' => 'Match', 'quantity' => '1', 'unit' => 'set','experiment_id' => 85],
            ['name' => 'Permanent Marker', 'quantity' => '1', 'unit' => 'set','experiment_id' => 85],
            ['name' => 'Distilled Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 85],

            //*Science Form 3 Experiment 2.2
            ['name' => 'Cigarette', 'quantity' => '200', 'unit' => 'cm³','experiment_id' => 86],
            ['name' => 'Cotton Wool', 'quantity' => '1', 'unit' => 'set','experiment_id' => 86],
            ['name' => 'Litmus Solution', 'quantity' => '1', 'unit' => 'set','experiment_id' => 86],
            ['name' => 'Lighter', 'quantity' => '1', 'unit' => 'set','experiment_id' => 86],

            //*Science Form 3 Experiment 3.1
            //*None

            //*Science Form 3 Experiment 3.2
            ['name' => 'Young Balsam Plant', 'quantity' => '1', 'unit' => 'set','experiment_id' => 88],
            ['name' => 'Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 88],
            ['name' => 'Cotton Wool', 'quantity' => '1', 'unit' => 'set','experiment_id' => 88],
            ['name' => 'Oil', 'quantity' => '1', 'unit' => 'set','experiment_id' => 88],

            //*Science Form 3 Experiment 3.3
            ['name' => 'Young Balsam Plant', 'quantity' => '1', 'unit' => 'set','experiment_id' => 89],
            ['name' => 'Anhydrous Calcium Chloride', 'quantity' => '1', 'unit' => 'set','experiment_id' => 89],
            ['name' => 'Cotton Wool', 'quantity' => '1', 'unit' => 'set','experiment_id' => 89],
            ['name' => 'Oil', 'quantity' => '1', 'unit' => 'set','experiment_id' => 89],
            ['name' => 'Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 89],

            //*Science Form 3 Experiment 3.4
            ['name' => 'Young Balsam Plant', 'quantity' => '1', 'unit' => 'set','experiment_id' => 90],
            ['name' => 'Cotton Wool', 'quantity' => '1', 'unit' => 'set','experiment_id' => 90],
            ['name' => 'Oil', 'quantity' => '1', 'unit' => 'set','experiment_id' => 90],
            ['name' => 'Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 90],

            //*Science Form 3 Experiment 3.5
            ['name' => 'Young Balsam Plant', 'quantity' => '1', 'unit' => 'set','experiment_id' => 91],
            ['name' => 'Cotton Wool', 'quantity' => '1', 'unit' => 'set','experiment_id' => 91],
            ['name' => 'Oil', 'quantity' => '1', 'unit' => 'set','experiment_id' => 91],
            ['name' => 'Water', 'quantity' => '1', 'unit' => 'set','experiment_id' => 91],

            //*Science Form 3 Experiment 5.1
            ['name' => 'Sodium Hydrogen Carbonate Powder', 'quantity' => '10', 'unit' => 'g','experiment_id' => 92],
            ['name' => 'Sodium Hydroxide', 'quantity' => '100', 'unit' => 'cm³','experiment_id' => 92,'concentration' => 0.1],
            ['name' => 'Sodium Hydroxide Powder', 'quantity' => '10', 'unit' => 'g','experiment_id' => 92],
            ['name' => 'Hydrochloric Acid', 'quantity' => '10', 'unit' => 'cm³','experiment_id' => 92,'concentration' => 0.1],
            ['name' => 'Distilled Water', 'quantity' => '200', 'unit' => 'cm³','experiment_id' => 92],

            //*Science Form 3 Experiment 6.1
            ['name' => 'Connecting Material', 'quantity' => '1', 'unit' => 'set','experiment_id' => 93],
            ['name' => 'Insulated Copper Wire', 'quantity' => '1', 'unit' => 'set','experiment_id' => 93,'concentration' => 0.1],
            ['name' => 'Light Bulb', 'quantity' => '2', 'unit' => 'g','experiment_id' => 93],

            

        ];
        foreach ($materials as $item) {
            Defaultmaterial::create($item);
        }

    }
}
