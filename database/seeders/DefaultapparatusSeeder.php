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
            //?Chemistry Form 4 Experiment 1.1
            ['name' => '150 cm³ Beaker', 'quantity' => '1','experiment_id' => 1],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Electronic Scale', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Glass Rod', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 1],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 1],

            //?Chemistry Form 4 Experiment 4.1
            ['name' => 'Forcep', 'quantity' => '1','experiment_id' => 2],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'White Tile', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'Basin', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'Knife', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'Combustion Spoon', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'Gas Jar with Lid', 'quantity' => '1','experiment_id' => 2],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 2],

            //?Chemistry Form 4 Experiment 4.2
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'Test Tube', 'quantity' => '14','experiment_id' => 3],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'Stopper', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'pH Meter', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'Glass rod', 'quantity' => '1','experiment_id' => 3],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 3],

            //?Chemistry Form 4 Experiment 5.1
            ['name' => 'Test Tube', 'quantity' => '6','experiment_id' => 4],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 4],
            ['name' => 'Evaporating Dish', 'quantity' => '2','experiment_id' => 4],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 4],
            ['name' => 'Evaporating Dish', 'quantity' => '1','experiment_id' => 4],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 4],
            ['name' => 'Pipeclay Triangle', 'quantity' => '1','experiment_id' => 4],
            ['name' => 'Beaker', 'quantity' => '1','experiment_id' => 4],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 4],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 4],
            ['name' => 'Battery', 'quantity' => '2','experiment_id' => 4],
            ['name' => 'Switch', 'quantity' => '1','experiment_id' => 4],
            ['name' => 'Light Bulb', 'quantity' => '1','experiment_id' => 4],
            ['name' => 'Carbon Electrode', 'quantity' => '2','experiment_id' => 4],
            
            //?Chemistry Form 4 Experiment 6.1
            ['name' => 'Test Tube', 'quantity' => '6','experiment_id' => 5],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 5],

            //?Chemistry Form 4 Experiment 6.2
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 6],
            ['name' => 'Stirring Rod', 'quantity' => '1','experiment_id' => 6],

            //?Chemistry Form 4 Experiment 6.3
            ['name' => '100 cm³ Beaker', 'quantity' => '3','experiment_id' => 7],
            ['name' => 'pH Meter', 'quantity' => '1','experiment_id' => 7],

            //?Chemistry Form 4 Experiment 6.4
            ['name' => '100 cm³ Beaker', 'quantity' => '3','experiment_id' => 8],
            ['name' => 'pH Meter', 'quantity' => '1','experiment_id' => 8],

            //?Chemistry Form 4 Experiment 6.5
            ['name' => 'Stirring Rod', 'quantity' => '1','experiment_id' => 9],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 9],
            ['name' => '100 cm³ Beaker', 'quantity' => '5','experiment_id' => 9],

            //?Chemistry Form 4 Experiment 6.6
            ['name' => 'Test Tube', 'quantity' => '6','experiment_id' => 10],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 10],
            ['name' => 'Stirring Rod', 'quantity' => '1','experiment_id' => 10],
            ['name' => 'Burette', 'quantity' => '2','experiment_id' => 10],
            ['name' => 'Retort Stand', 'quantity' => '2','experiment_id' => 10],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 10],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 10],

            //?Chemistry Form 4 Experiment 6.7
            ['name' => 'Test Tube', 'quantity' => '5','experiment_id' => 11],
            ['name' => 'Boiling Tube', 'quantity' => '5','experiment_id' => 11],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 11],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 11],
            ['name' => 'Rubber Stopper', 'quantity' => '5','experiment_id' => 11],
            ['name' => 'Delivery Tube', 'quantity' => '5','experiment_id' => 11],

            //?Chemistry Form 4 Experiment 6.8
            ['name' => 'Test Tube', 'quantity' => '5','experiment_id' => 12],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 12],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 12],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 12],

            //?Chemistry Form 4 Experiment 6.9
            ['name' => 'Test Tube', 'quantity' => '16','experiment_id' => 13],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 13],
            ['name' => 'Stirring Rod', 'quantity' => '1','experiment_id' => 13],
            ['name' => 'Dropper', 'quantity' => '4','experiment_id' => 13],
            ['name' => 'Rubber Stopper', 'quantity' => '4','experiment_id' => 13],
            ['name' => 'Delivery Tube', 'quantity' => '4','experiment_id' => 13],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 13],
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 13],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 13],

            //?Chemistry Form 4 Experiment 6.10
            ['name' => 'Test Tube', 'quantity' => '8','experiment_id' => 14],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 14],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 14],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 14],
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 14],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 14],
            ['name' => 'Red Litmus Paper', 'quantity' => '1','experiment_id' => 14],

            //?Chemistry Form 4 Experiment 6.11
            ['name' => 'Test Tube', 'quantity' => '4','experiment_id' => 15],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 15],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 15],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 15],
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 15],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 15],


            //?Chemistry Form 4 Experiment 7.1
            ['name' => '250 cm³ Conical Flask', 'quantity' => '2','experiment_id' => 16],
            ['name' => 'Retort Stand', 'quantity' => '2','experiment_id' => 16],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 16],
            ['name' => 'Burrete', 'quantity' => '2','experiment_id' => 16],
            ['name' => 'Basin', 'quantity' => '2','experiment_id' => 16],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 16],
            ['name' => 'Rubber Stopper', 'quantity' => '2','experiment_id' => 16],
            ['name' => 'Delivery Tube', 'quantity' => '2','experiment_id' => 16],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 16],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 16],


            //?Chemistry Form 4 Experiment 7.2
            ['name' => '150 cm³ Conical Flask', 'quantity' => '2','experiment_id' => 17],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 17],
            ['name' => '50 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 17],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 17],

            //?Chemistry Form 4 Experiment 7.3
            ['name' => '150 cm³ Conical Flask', 'quantity' => '2','experiment_id' => 18],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 18],
            ['name' => '50 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 18],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 18],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 18],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 18],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 18],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 18],

            //?Chemistry Form 4 Experiment 7.4
            ['name' => '150 cm³ Beaker', 'quantity' => '2','experiment_id' => 19],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 19],
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 19],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 19],
            ['name' => 'Wooden Splinter', 'quantity' => '2','experiment_id' => 19],
            ['name' => 'Filter Funnel', 'quantity' => '2','experiment_id' => 19],
            ['name' => 'Filter Paper', 'quantity' => '2','experiment_id' => 19],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 19],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 19],

            //?Chemistry Form 4 Experiment 8.1
            ['name' => '100 cm³ Beaker', 'quantity' => '2','experiment_id' => 20],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 20],
            ['name' => 'Sandpaper', 'quantity' => '2','experiment_id' => 20],
            ['name' => 'Steel Ball Bearing', 'quantity' => '1','experiment_id' => 20],
            ['name' => '1 Kg Weight', 'quantity' => '1','experiment_id' => 20],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 20],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 20],
            ['name' => 'Meter Ruler', 'quantity' => '1','experiment_id' => 20],
            ['name' => 'Cellophane Tape', 'quantity' => '1','experiment_id' => 20],

            //!Physics Form 4 Experiment 1.1
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 21],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 21],
            ['name' => 'Pendulum Bob', 'quantity' => '1','experiment_id' => 21],
            ['name' => 'String', 'quantity' => '1','experiment_id' => 21],
            ['name' => 'Protractor', 'quantity' => '1','experiment_id' => 21],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 21],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 21],

            //!Physics Form 4 Experiment 2.1
            ['name' => 'Photogate System', 'quantity' => '1','experiment_id' => 22],
            ['name' => 'Electronic Timer', 'quantity' => '1','experiment_id' => 22],
            ['name' => 'Electromagnetic Release', 'quantity' => '1','experiment_id' => 22],
            ['name' => 'Steel Ball', 'quantity' => '1','experiment_id' => 22],
            ['name' => 'Container', 'quantity' => '1','experiment_id' => 22],

            //!Physics Form 4 Experiment 2.2
            ['name' => 'G-Clamp', 'quantity' => '1','experiment_id' => 23],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 23],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 23],
            ['name' => 'Jigsaw Blade', 'quantity' => '1','experiment_id' => 23],

            //!Physics Form 4 Experiment 4.1
            ['name' => 'Power Supply', 'quantity' => '1','experiment_id' => 24],
            ['name' => 'Immersion Heater', 'quantity' => '1','experiment_id' => 24],
            ['name' => 'Beaker', 'quantity' => '1','experiment_id' => 24],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 24],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 24],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 24],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 24],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 24],

            //!Physics Form 4 Experiment 4.2
            ['name' => 'Power Supply', 'quantity' => '1','experiment_id' => 25],
            ['name' => 'Immersion Heater', 'quantity' => '1','experiment_id' => 25],
            ['name' => '1 Kg Aluminium Block', 'quantity' => '1','experiment_id' => 25],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 25],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 25],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 25],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 25],

            //!Physics Form 4 Experiment 4.3
            ['name' => 'Power Supply', 'quantity' => '1','experiment_id' => 26],
            ['name' => 'Immersion Heater', 'quantity' => '1','experiment_id' => 26],
            ['name' => 'Beaker', 'quantity' => '1','experiment_id' => 26],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 26],
            ['name' => 'Filter Funnel', 'quantity' => '1','experiment_id' => 26],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 26],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 26],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 26],

            //!Physics Form 4 Experiment 4.4
            ['name' => '100 mL Syringe', 'quantity' => '1','experiment_id' => 27],
            ['name' => 'Rubber Tube', 'quantity' => '1','experiment_id' => 27],
            ['name' => 'Pressure Gauge', 'quantity' => '1','experiment_id' => 27],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 27],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 27],

            //!Physics Form 4 Experiment 4.5
            ['name' => 'Capillary Tube(Air Trapped with Concentrated Sulphuric Acid)', 'quantity' => '1','experiment_id' => 28],
            ['name' => '500 cm³ Beaker', 'quantity' => '1','experiment_id' => 28],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 28],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 28],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 28],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 28],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 28],
            ['name' => 'Stirring Rod', 'quantity' => '1','experiment_id' => 28],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 28],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 28],

            //!Physics Form 4 Experiment 4.6
            ['name' => 'Sealed Syringe', 'quantity' => '1','experiment_id' => 29],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 29],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 29],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 29],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 29],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 29],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 29],

            //!Physics Form 4 Experiment 6.1
            ['name' => 'Ray Box with Single Slit', 'quantity' => '1','experiment_id' => 30],
            ['name' => 'Protractor', 'quantity' => '1','experiment_id' => 30],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 30],

            //!Physics Form 4 Experiment 6.2
            ['name' => '1000 cm³ Beaker', 'quantity' => '1','experiment_id' => 31],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 31],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 31],
            ['name' => 'Clamp', 'quantity' => '2','experiment_id' => 31],


        ];
        foreach ($apparatus as $item) {
            Defaultapparatus::create($item);
        }
    }
}
