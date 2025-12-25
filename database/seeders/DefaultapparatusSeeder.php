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
            ['name' => 'Stirring Rod', 'quantity' => '1','experiment_id' => 1],
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
            ['name' => 'Stirring Rod', 'quantity' => '1','experiment_id' => 3],
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

            //?Chemistry Form 5 Experiment 1A
            ['name' => 'Connective Wire', 'quantity' => '8','experiment_id' => 32],
            ['name' => 'Crocodile Clip', 'quantity' => '8','experiment_id' => 32],
            ['name' => 'Voltmeter', 'quantity' => '1','experiment_id' => 32],
            ['name' => 'Carbon Electrode', 'quantity' => '8','experiment_id' => 32],
            ['name' => 'Salt Bridge', 'quantity' => '4','experiment_id' => 32],
            ['name' => '100 cm³ Beaker', 'quantity' => '8','experiment_id' => 32],

            //?Chemistry Form 5 Experiment 1B
            ['name' => 'Electrolytic Cell', 'quantity' => '2','experiment_id' => 33],
            ['name' => 'Battery', 'quantity' => '4','experiment_id' => 33],
            ['name' => 'Crocodile Clip', 'quantity' => '4','experiment_id' => 33],
            ['name' => 'Ammeter', 'quantity' => '2','experiment_id' => 33],
            ['name' => 'Test Tube', 'quantity' => '4','experiment_id' => 33],
            //?Chemistry Form 5 Experiment 1C
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 34],
            ['name' => 'Battery', 'quantity' => '2','experiment_id' => 34],
            ['name' => 'Carbon Electrode', 'quantity' => '1','experiment_id' => 34],
            ['name' => 'Copper Electrode', 'quantity' => '1','experiment_id' => 34],
            ['name' => 'Crocodile Clip', 'quantity' => '2','experiment_id' => 34],
            ['name' => 'Switch', 'quantity' => '1','experiment_id' => 34],
            ['name' => 'Ammeter', 'quantity' => '1','experiment_id' => 34],
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 34],
            ['name' => 'Connecting Wire', 'quantity' => '2','experiment_id' => 34],

            //?Chemistry Form 5 Experiment 1D
            ['name' => 'Test Tube', 'quantity' => '1','experiment_id' => 35],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 35],
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 35],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 35],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 35],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 35],
            //?Chemistry Form 5 Experiment 1E
            ['name' => 'Test Tube', 'quantity' => '5','experiment_id' => 36],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 36],
            ['name' => 'Sandpaper', 'quantity' => '1','experiment_id' => 36],

            //?Chemistry Form 5 Experiment 2A
            ['name' => 'Evaporating Dish', 'quantity' => '2','experiment_id' => 37],
            ['name' => 'Measuring Cylinder', 'quantity' => '1','experiment_id' => 37],
            ['name' => 'Test Tube', 'quantity' => '4','experiment_id' => 37],
            ['name' => 'Dropper', 'quantity' => '4','experiment_id' => 37],

            //?Chemistry Form 5 Experiment 3A
            ['name' => 'Polystyrene Cup with Lids', 'quantity' => '3','experiment_id' => 38],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 38],
            ['name' => 'Test Tube', 'quantity' => '4','experiment_id' => 38],
            ['name' => 'Thermometer', 'quantity' => '4','experiment_id' => 38],

            //?Chemistry Form 5 Experiment 3B
            ['name' => 'Copper Can', 'quantity' => '3','experiment_id' => 39],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 39],
            ['name' => 'Pipeclay Triangle', 'quantity' => '1','experiment_id' => 39],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 39],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 39],
            ['name' => 'Spirit Lamp', 'quantity' => '4','experiment_id' => 39],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 39],
            ['name' => 'Wind Shield', 'quantity' => '2','experiment_id' => 39],
            ['name' => 'Wooden Block', 'quantity' => '1','experiment_id' => 39],

            //?Chemistry Form 5 Experiment 4A
            ['name' => '100 cm³ Beaker', 'quantity' => '3','experiment_id' => 40],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 40],
            ['name' => 'Stirring Rod', 'quantity' => '1','experiment_id' => 40],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 40],

            //?Chemistry Form 5 Experiment 4B
            ['name' => 'Retort Stand', 'quantity' => '3','experiment_id' => 41],
            ['name' => 'Bulldog Clip', 'quantity' => '1','experiment_id' => 41],
            ['name' => '50 g Weight', 'quantity' => '1','experiment_id' => 41],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 41],

            //?Chemistry Form 5 Experiment 5A
            ['name' => 'Hard Water', 'quantity' => '1','experiment_id' => 42],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 42],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 42],
            ['name' => 'Stirring Rod', 'quantity' => '1','experiment_id' => 42],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 42],



            //*Science Form 4 Experiment 3.1
            //*None

            //*Science Form 4 Experiment 9.1
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 44],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 44],
            ['name' => '1 Kg Steel Ball', 'quantity' => '1','experiment_id' => 44],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 44],
            ['name' => 'Short Ruler', 'quantity' => '1','experiment_id' => 44],

            //*Science Form 4 Experiment 9.2
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 45],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 45],

            //*Science Form 4 Experiment 11.1
            ['name' => 'Ticker Timer', 'quantity' => '1','experiment_id' => 46],
            ['name' => 'Weight', 'quantity' => '1','experiment_id' => 46],
            ['name' => 'G-Clamp', 'quantity' => '1','experiment_id' => 46],
            ['name' => 'AC Power Supply', 'quantity' => '1','experiment_id' => 46],
            ['name' => 'Softboard', 'quantity' => '1','experiment_id' => 46],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 46],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 46],

            //*Science Form 4 Experiment 11.2
            ['name' => 'Piece of Paper', 'quantity' => '1','experiment_id' => 47],

            //*Science Form 5 Experiment 11.3
            ['name' => 'G-Clamp', 'quantity' => '1','experiment_id' => 48],
            ['name' => 'Hacksaw Blade', 'quantity' => '1','experiment_id' => 48],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 48],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 48],





            //*Science Form 5 Experiment 1.1
            ['name' => 'Petri Dish', 'quantity' => '4','experiment_id' => 49],
            ['name' => 'Lid', 'quantity' => '4','experiment_id' => 49],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 49],

            //*Science Form 5 Experiment 1.2
            ['name' => 'Petri Dish', 'quantity' => '12','experiment_id' => 50],
            ['name' => 'Lid', 'quantity' => '12','experiment_id' => 50],
            ['name' => 'Wire Loop', 'quantity' => '7','experiment_id' => 50],
            ['name' => 'Oven', 'quantity' => '1','experiment_id' => 50],
            ['name' => 'Refrigerator', 'quantity' => '1','experiment_id' => 50],
            ['name' => 'Incubator', 'quantity' => '1','experiment_id' => 50],
            ['name' => 'Thermometer', 'quantity' => '5','experiment_id' => 50],
            ['name' => '100 cm³ Beaker', 'quantity' => '12','experiment_id' => 50],
            ['name' => 'Syringe', 'quantity' => '3','experiment_id' => 50],

            //*Science Form 5 Experiment 2.1
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 51],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 51],
            ['name' => 'Boiling Tube', 'quantity' => '1','experiment_id' => 51],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 51],
            ['name' => 'Shield', 'quantity' => '2','experiment_id' => 51],
            ['name' => 'Plasticine', 'quantity' => '1','experiment_id' => 51],
            ['name' => 'Needle', 'quantity' => '1','experiment_id' => 51],

            //*Science Form 5 Experiment 2.2
            ['name' => 'Boiling Tube', 'quantity' => '4','experiment_id' => 52],
            ['name' => 'Connecting Tube', 'quantity' => '4','experiment_id' => 52],
            ['name' => 'Air Pump', 'quantity' => '1','experiment_id' => 52],
            ['name' => 'Cork', 'quantity' => '4','experiment_id' => 52],

            //*Science Form 5 Experiment 4.1
            ['name' => 'Boiling Tube', 'quantity' => '4','experiment_id' => 53],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 53],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 53],
            ['name' => 'Cork', 'quantity' => '4','experiment_id' => 53],

            //*Science Form 5 Experiment 4.2
            ['name' => '250 cm³ Conical Flask', 'quantity' => '4','experiment_id' => 54],
            ['name' => '50 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 54],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 54],
            ['name' => 'Stopwatch', 'quantity' => '4','experiment_id' => 54],

            //*Science Form 5 Experiment 4.3
            ['name' => '250 cm³ Conical Flask', 'quantity' => '5','experiment_id' => 55],
            ['name' => '50 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 55],
            ['name' => 'Rubber Stopper', 'quantity' => '5','experiment_id' => 55],
            ['name' => 'Delivery Tube', 'quantity' => '1','experiment_id' => 55],
            ['name' => 'Burette', 'quantity' => '1','experiment_id' => 55],
            ['name' => 'Basin', 'quantity' => '1','experiment_id' => 55],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 55],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 55],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 55],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 55],

            //*Science Form 5 Experiment 4.4
            ['name' => '250 cm³ Conical Flask', 'quantity' => '2','experiment_id' => 56],
            ['name' => '50 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 56],
            ['name' => 'Rubber Stopper', 'quantity' => '2','experiment_id' => 56],
            ['name' => 'Delivery Tube', 'quantity' => '2','experiment_id' => 56],
            ['name' => 'Burette', 'quantity' => '2','experiment_id' => 56],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 56],
            ['name' => 'Retort Stand', 'quantity' => '2','experiment_id' => 56],
            ['name' => 'Clamp', 'quantity' => '2','experiment_id' => 56],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 56],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 56],
            ['name' => 'Filter Paper', 'quantity' => '2','experiment_id' => 56],
            ['name' => 'Basin', 'quantity' => '1','experiment_id' => 56],

            //*Science Form 5 Experiment 5.1
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 57],
            ['name' => '10 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 57],
            ['name' => 'Stirring Rod', 'quantity' => '1','experiment_id' => 57],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 57],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 57],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 57],
            ['name' => 'Filter Funnel', 'quantity' => '1','experiment_id' => 57],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 57],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 57],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 57],
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 57],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 57],
            ['name' => '250 cm³ Conical Flask', 'quantity' => '1','experiment_id' => 57],

            //*Science Form 5 Experiment 6.1
            ['name' => 'Battery', 'quantity' => '6','experiment_id' => 58],
            ['name' => 'Carbon Electrode', 'quantity' => '6','experiment_id' => 58],
            ['name' => 'Connecting Wire', 'quantity' => '3','experiment_id' => 58],
            ['name' => 'Crocodile Clip', 'quantity' => '6','experiment_id' => 58],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 58],
            ['name' => 'Tripod Stand', 'quantity' => '2','experiment_id' => 58],
            ['name' => 'Crucible', 'quantity' => '2','experiment_id' => 58],
            ['name' => 'Pipeclay Triangle', 'quantity' => '2','experiment_id' => 58],
            ['name' => 'Switch', 'quantity' => '3','experiment_id' => 58],
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 58],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 58],
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 58],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 58],
            ['name' => 'Electrolytic Cell', 'quantity' => '1','experiment_id' => 58],
            ['name' => 'Light Bulb', 'quantity' => '3','experiment_id' => 58],

            //*Science Form 5 Experiment 6.2
            ['name' => 'Battery', 'quantity' => '4','experiment_id' => 59],
            ['name' => 'Carbon Electrode', 'quantity' => '4','experiment_id' => 59],
            ['name' => 'Connecting Wire', 'quantity' => '2','experiment_id' => 59],
            ['name' => 'Crocodile Clip', 'quantity' => '4','experiment_id' => 59],
            ['name' => 'Switch', 'quantity' => '2','experiment_id' => 59],
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 59],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 59],
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 59],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 59],
            ['name' => 'Electrolytic Cell', 'quantity' => '1','experiment_id' => 59],

            //*Science Form 5 Experiment 6.3
            ['name' => 'Battery', 'quantity' => '4','experiment_id' => 60],
            ['name' => 'Carbon Electrode', 'quantity' => '4','experiment_id' => 60],
            ['name' => 'Connecting Wire', 'quantity' => '4','experiment_id' => 60],
            ['name' => 'Crocodile Clip', 'quantity' => '4','experiment_id' => 60],
            ['name' => 'Switch', 'quantity' => '2','experiment_id' => 60],
            ['name' => '100 cm³ Beaker', 'quantity' => '2','experiment_id' => 60],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 60],
            ['name' => 'Test Tube', 'quantity' => '4','experiment_id' => 60],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 60],
            ['name' => 'Electrolytic Cell', 'quantity' => '1','experiment_id' => 60],

            //*Science Form 5 Experiment 6.4
            ['name' => 'Battery', 'quantity' => '4','experiment_id' => 61],
            ['name' => 'Carbon Electrode', 'quantity' => '2','experiment_id' => 61],
            ['name' => 'Copper Electrode', 'quantity' => '2','experiment_id' => 61],
            ['name' => 'Connecting Wire', 'quantity' => '2','experiment_id' => 61],
            ['name' => 'Crocodile Clip', 'quantity' => '4','experiment_id' => 61],
            ['name' => 'Switch', 'quantity' => '2','experiment_id' => 61],
            ['name' => '100 cm³ Beaker', 'quantity' => '2','experiment_id' => 61],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 61],
            ['name' => 'Test Tube', 'quantity' => '4','experiment_id' => 61],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 61],
            ['name' => 'Electrolytic Cell', 'quantity' => '1','experiment_id' => 61],


            //*Science Form 1 Experiment 1.1
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 62],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 62],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 62],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 62],

            //*Science Form 1 Experiment 2.1
            ['name' => 'Boiling Tube', 'quantity' => '1','experiment_id' => 63],
            ['name' => 'White Tile', 'quantity' => '1','experiment_id' => 63],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 63],
            ['name' => 'Forcep', 'quantity' => '1','experiment_id' => 63],
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 63],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 63],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 63],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 63],

            //*Science Form 1 Experiment 2.2
            ['name' => 'Boiling Tube', 'quantity' => '1','experiment_id' => 64],
            ['name' => 'White Tile', 'quantity' => '1','experiment_id' => 64],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 64],
            ['name' => 'Forcep', 'quantity' => '1','experiment_id' => 64],
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 64],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 64],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 64],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 64],

            //*Science Form 1 Experiment 2.3
            ['name' => 'Bell Jar', 'quantity' => '2','experiment_id' => 65],
            ['name' => 'Boiling Tube', 'quantity' => '1','experiment_id' => 65],
            ['name' => 'White Tile', 'quantity' => '1','experiment_id' => 65],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 65],
            ['name' => 'Forcep', 'quantity' => '1','experiment_id' => 65],
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 65],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 65],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 65],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 65],
            ['name' => 'Glass Plate', 'quantity' => '1','experiment_id' => 65],

            //*Science Form 1 Experiment 2.4
            ['name' => 'Boiling Tube', 'quantity' => '1','experiment_id' => 66],
            ['name' => 'White Tile', 'quantity' => '1','experiment_id' => 66],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 66],
            ['name' => 'Forcep', 'quantity' => '1','experiment_id' => 66],
            ['name' => '100 cm³ Beaker', 'quantity' => '1','experiment_id' => 66],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 66],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 66],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 66],

            //*Science Form 1 Experiment 3.1
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 67],

            //*Science Form 1 Experiment 3.2
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 68],

            //*Science Form 1 Experiment 4.1
            ['name' => 'Boiling Tube', 'quantity' => '2','experiment_id' => 69],

            //*Science Form 1 Experiment 5.1
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 70],
            ['name' => 'Rubber Stopper', 'quantity' => '2','experiment_id' => 70],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '2','experiment_id' => 70],
            ['name' => 'Stopwatch', 'quantity' => '2','experiment_id' => 70],
            

            //*Science Form 1 Experiment 6.2
            ['name' => 'Sandpaper', 'quantity' => '1','experiment_id' => 71],
            ['name' => 'Dry Cell', 'quantity' => '1','experiment_id' => 71],
            ['name' => 'Ammeter', 'quantity' => '1','experiment_id' => 71],
            ['name' => 'Crocodile Clip', 'quantity' => '2','experiment_id' => 71],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 71],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 71],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 71],
            ['name' => 'Thermometer', 'quantity' => '2','experiment_id' => 71],
            ['name' => 'Crucible', 'quantity' => '2','experiment_id' => 71],
            ['name' => 'Bunsen Burner', 'quantity' => '2','experiment_id' => 71],
            ['name' => 'Pipeclay Triangle', 'quantity' => '2','experiment_id' => 71],

            //*Science Form 1 Experiment 8.1
            ['name' => 'Power Supply', 'quantity' => '1','experiment_id' => 72],
            ['name' => 'Protractor', 'quantity' => '1','experiment_id' => 72],
            ['name' => 'Ray Box', 'quantity' => '1','experiment_id' => 72],

            //*Science Form 1 Experiment 8.2
            ['name' => 'Power Supply', 'quantity' => '1','experiment_id' => 73],
            ['name' => 'Protractor', 'quantity' => '1','experiment_id' => 73],
            ['name' => 'Ray Box', 'quantity' => '1','experiment_id' => 73],
            ['name' => 'Single Slit Plate', 'quantity' => '1','experiment_id' => 73],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 73],


            //*Science Form 2 Experiment 2.1
            ['name' => 'Petri Dish with Partition', 'quantity' => '2','experiment_id' => 74],
            ['name' => 'Petri Dish Lid', 'quantity' => '2','experiment_id' => 74],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 74],
            ['name' => 'Pliers', 'quantity' => '1','experiment_id' => 74],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 74],
            ['name' => 'Wire Gauze Mould', 'quantity' => '1','experiment_id' => 74],

            //*Science Form 2 Experiment 3.1
            ['name' => 'Boiling Tube', 'quantity' => '2','experiment_id' => 75],
            ['name' => '100 cm³ Beaker', 'quantity' => '2','experiment_id' => 75],
            ['name' => 'Test Tube', 'quantity' => '1','experiment_id' => 75],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 75],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 75],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 75],
            ['name' => 'Thread', 'quantity' => '1','experiment_id' => 75],

            //*Science Form 2 Experiment 5.1
            ['name' => 'Bell Jar', 'quantity' => '2','experiment_id' => 76],
            ['name' => '100 cm³ Beaker', 'quantity' => '2','experiment_id' => 76],
            ['name' => 'Rubber Stopper', 'quantity' => '2','experiment_id' => 76],
            ['name' => 'Fillament Lamp', 'quantity' => '1','experiment_id' => 76],
            ['name' => 'White Tile', 'quantity' => '1','experiment_id' => 76],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 76],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 76],
            ['name' => 'Microscope Slide', 'quantity' => '1','experiment_id' => 76],
            ['name' => 'Fan', 'quantity' => '1','experiment_id' => 76],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 76],

            //*Science Form 2 Experiment 5.2
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 77],
            ['name' => '100 cm³ Beaker', 'quantity' => '5','experiment_id' => 77],
            ['name' => 'Stirring Rod', 'quantity' => '4','experiment_id' => 77],
            ['name' => 'Gas Jar Stand', 'quantity' => '1','experiment_id' => 77],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 77],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 77],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 77],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 77],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 77],

            //*Science Form 2 Experiment 7.1
            ['name' => 'Ammeter', 'quantity' => '1','experiment_id' => 78],
            ['name' => 'Voltmeter', 'quantity' => '1','experiment_id' => 78],
            ['name' => 'Connecting Wire', 'quantity' => '3','experiment_id' => 78],
            ['name' => 'Switch', 'quantity' => '1','experiment_id' => 78],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 78],
            ['name' => 'Dry Cell', 'quantity' => '1','experiment_id' => 78],
            ['name' => 'Dry Cell Holder', 'quantity' => '1','experiment_id' => 78],
            ['name' => 'Crocodile Clip', 'quantity' => '5','experiment_id' => 78],

            //*Science Form 2 Experiment 7.2
            ['name' => 'D.C Power Supply', 'quantity' => '1','experiment_id' => 79],
            ['name' => 'Ammeter', 'quantity' => '1','experiment_id' => 79],
            ['name' => 'Rheostat', 'quantity' => '3','experiment_id' => 79],
            ['name' => 'Petri Dish', 'quantity' => '1','experiment_id' => 79],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 79],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 79],

            //*Science Form 2 Experiment 8.1
            ['name' => 'Weighing Scale', 'quantity' => '1','experiment_id' => 80],
            ['name' => 'Glass Basin', 'quantity' => '1','experiment_id' => 80],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 80],

            //*Science Form 2 Experiment 8.2
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 81],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 81],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 81],
            ['name' => 'Thread', 'quantity' => '1','experiment_id' => 81],

            //*Science Form 2 Experiment 9.1
            ['name' => 'Flat-Bottom Flask', 'quantity' => '1','experiment_id' => 82],
            ['name' => 'Rubber Stopper', 'quantity' => '1','experiment_id' => 82],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 82],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 82],

            //*Science Form 2 Experiment 9.2
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 83],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 83],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 83],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 83],



            //*Science Form 3 Experiment 1.1
            ['name' => 'Glass Basin', 'quantity' => '1','experiment_id' => 84],
            ['name' => 'Gas Jar', 'quantity' => '1','experiment_id' => 84],
            ['name' => 'Cover', 'quantity' => '1','experiment_id' => 84],
            ['name' => 'Gas Jar Stand', 'quantity' => '1','experiment_id' => 84],
            ['name' => '150 cm³ Conical Flask', 'quantity' => '1','experiment_id' => 84],
            ['name' => 'Connecting Tube', 'quantity' => '1','experiment_id' => 84],
            ['name' => 'Rubber Tubing', 'quantity' => '1','experiment_id' => 84],
            ['name' => 'Glass Tube', 'quantity' => '1','experiment_id' => 84],
            ['name' => 'Rubber Stopper', 'quantity' => '1','experiment_id' => 84],

            //*Science Form 3 Experiment 2.1
            ['name' => 'Glass Basin', 'quantity' => '1','experiment_id' => 85],
            ['name' => 'Gas Jar', 'quantity' => '1','experiment_id' => 85],
            ['name' => 'Cover', 'quantity' => '1','experiment_id' => 85],
            ['name' => 'Gas Jar Stand', 'quantity' => '1','experiment_id' => 85],
            ['name' => '150 cm³ Conical Flask', 'quantity' => '1','experiment_id' => 85],
            ['name' => 'Connecting Tube', 'quantity' => '1','experiment_id' => 85],
            ['name' => 'Rubber Tubing', 'quantity' => '1','experiment_id' => 85],
            ['name' => 'Glass Tube', 'quantity' => '1','experiment_id' => 85],
            ['name' => 'Rubber Stopper', 'quantity' => '1','experiment_id' => 85],

            //*Science Form 3 Experiment 2.2
            ['name' => 'U-Tube', 'quantity' => '1','experiment_id' => 86],
            ['name' => '150 cm³ Conical Flask', 'quantity' => '1','experiment_id' => 86],
            ['name' => 'Rubber Stopper', 'quantity' => '1','experiment_id' => 86],
            ['name' => 'Filter Pump', 'quantity' => '1','experiment_id' => 86],
            ['name' => 'Rubber Tube', 'quantity' => '1','experiment_id' => 86],
            ['name' => 'Glass Tube', 'quantity' => '1','experiment_id' => 86],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 86],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 86],
            ['name' => 'Wooden Block', 'quantity' => '1','experiment_id' => 86],

            //*Science Form 3 Experiment 3.1
            ['name' => 'Watch', 'quantity' => '1','experiment_id' => 87],

            //*Science Form 3 Experiment 3.2
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 88],
            ['name' => '150 cm³ Conical Flask', 'quantity' => '1','experiment_id' => 88],
            ['name' => 'Clock', 'quantity' => '1','experiment_id' => 88],

            //*Science Form 3 Experiment 3.3
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 88],
            ['name' => '150 cm³ Conical Flask', 'quantity' => '1','experiment_id' => 88],
            ['name' => 'Clock', 'quantity' => '1','experiment_id' => 88],
            ['name' => 'Plastic Bag', 'quantity' => '1','experiment_id' => 89],

            //*Science Form 3 Experiment 3.4
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 90],
            ['name' => '150 cm³ Conical Flask', 'quantity' => '1','experiment_id' => 90],
            ['name' => 'Clock', 'quantity' => '1','experiment_id' => 90],
            ['name' => 'Fan', 'quantity' => '1','experiment_id' => 90],

            //*Science Form 3 Experiment 3.5
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 91],
            ['name' => '150 cm³ Conical Flask', 'quantity' => '1','experiment_id' => 91],
            ['name' => 'Clock', 'quantity' => '1','experiment_id' => 91],

            //*Science Form 3 Experiment 5.1
            ['name' => 'Polysterene Cup', 'quantity' => '4','experiment_id' => 92],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 92],
            ['name' => 'Spatula', 'quantity' => '1','experiment_id' => 92],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 92],

            //*Science Form 3 Experiment 6.1
            ['name' => 'Power Supply', 'quantity' => '1','experiment_id' => 93],
            ['name' => 'Laminated C-Shaped Soft Core', 'quantity' => '1','experiment_id' => 93],

            //!Physics Form 5 Experiment 1.1
            ['name' => 'Retort Stand', 'quantity' => '2','experiment_id' => 94],
            ['name' => 'Clamp', 'quantity' => '2','experiment_id' => 94],
            ['name' => '10 cm Spring', 'quantity' => '1','experiment_id' => 94],
            ['name' => '10 g Weight', 'quantity' => '5','experiment_id' => 94],
            ['name' => '20 g Weight', 'quantity' => '5','experiment_id' => 94],
            ['name' => '50 g Weight', 'quantity' => '5','experiment_id' => 94],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 94],

            //!Physics Form 5 Experiment 2.1
            ['name' => '500 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 95],
            ['name' => 'Silicone Tube', 'quantity' => '1','experiment_id' => 95],
            ['name' => 'Thistle Funnel', 'quantity' => '1','experiment_id' => 95],
            ['name' => 'Thin Sheet of Rubber', 'quantity' => '1','experiment_id' => 95],
            ['name' => 'U-Tube', 'quantity' => '1','experiment_id' => 95],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 95],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 95],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 95],

            //!Physics Form 5 Experiment 2.2
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 96],
            ['name' => '600 cm³ Beaker', 'quantity' => '3','experiment_id' => 96],
            ['name' => 'U-Tube', 'quantity' => '1','experiment_id' => 96],
            ['name' => 'Silicone Tube', 'quantity' => '1','experiment_id' => 96],
            ['name' => 'Thistle Funnel', 'quantity' => '1','experiment_id' => 96],
            ['name' => 'Thin Sheet of Rubber', 'quantity' => '6','experiment_id' => 96],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 96],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 96],

            //!Physics Form 5 Experiment 2.3
            ['name' => 'Weight', 'quantity' => '1','experiment_id' => 97],
            ['name' => 'Eureka Can', 'quantity' => '1','experiment_id' => 97],
            ['name' => '100 cm³ Beaker', 'quantity' => '3','experiment_id' => 97],
            ['name' => 'Spring Balance', 'quantity' => '1','experiment_id' => 97],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 97],
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 97],
            ['name' => 'Wooden Block', 'quantity' => '6','experiment_id' => 97],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 97],

            //!Physics Form 5 Experiment 3.1
            ['name' => '1.5 V Dry Cell', 'quantity' => '1','experiment_id' => 98],
            ['name' => 'Cell Holder', 'quantity' => '1','experiment_id' => 98],
            ['name' => 'Switch', 'quantity' => '1','experiment_id' => 98],
            ['name' => 'Connecting Wire', 'quantity' => '1','experiment_id' => 98],
            ['name' => 'Ammeter', 'quantity' => '1','experiment_id' => 98],
            ['name' => 'Voltmeter', 'quantity' => '1','experiment_id' => 98],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 98],
            ['name' => 'Rheostat', 'quantity' => '1','experiment_id' => 98],
            ['name' => 'Fillament Bulb', 'quantity' => '1','experiment_id' => 98],

            //!Physics Form 5 Experiment 3.2
            ['name' => '1.5 V Dry Cell', 'quantity' => '1','experiment_id' => 99],
            ['name' => 'Cell Holder', 'quantity' => '1','experiment_id' => 99],
            ['name' => 'Switch', 'quantity' => '1','experiment_id' => 99],
            ['name' => 'Connecting Wire', 'quantity' => '1','experiment_id' => 99],
            ['name' => 'Ammeter', 'quantity' => '1','experiment_id' => 99],
            ['name' => 'Voltmeter', 'quantity' => '1','experiment_id' => 99],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 99],
            ['name' => 'Rheostat', 'quantity' => '1','experiment_id' => 99],

            //!Physics Form 5 Experiment 3.3
            ['name' => '1.5 V Dry Cell', 'quantity' => '1','experiment_id' => 100],
            ['name' => 'Cell Holder', 'quantity' => '1','experiment_id' => 100],
            ['name' => 'Switch', 'quantity' => '1','experiment_id' => 100],
            ['name' => 'Connecting Wire', 'quantity' => '1','experiment_id' => 100],
            ['name' => 'Ammeter', 'quantity' => '1','experiment_id' => 100],
            ['name' => 'Voltmeter', 'quantity' => '1','experiment_id' => 100],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 100],
            ['name' => 'Rheostat', 'quantity' => '1','experiment_id' => 100],

            //!Physics Form 5 Experiment 3.4
            ['name' => '1.5 V Dry Cell', 'quantity' => '1','experiment_id' => 101],
            ['name' => 'Cell Holder', 'quantity' => '1','experiment_id' => 101],
            ['name' => 'Switch', 'quantity' => '1','experiment_id' => 101],
            ['name' => 'Connecting Wire', 'quantity' => '1','experiment_id' => 101],
            ['name' => 'Ammeter', 'quantity' => '1','experiment_id' => 101],
            ['name' => 'Voltmeter', 'quantity' => '1','experiment_id' => 101],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 101],
            ['name' => 'Rheostat', 'quantity' => '1','experiment_id' => 101],
            ['name' => 'Crocodile Clip', 'quantity' => '2','experiment_id' => 101],

            //!Physics Form 5 Experiment 3.5
            ['name' => '1.5 V Dry Cell', 'quantity' => '1','experiment_id' => 102],
            ['name' => 'Cell Holder', 'quantity' => '1','experiment_id' => 102],
            ['name' => 'Switch', 'quantity' => '1','experiment_id' => 102],
            ['name' => 'Connecting Wire', 'quantity' => '1','experiment_id' => 102],
            ['name' => 'Ammeter', 'quantity' => '1','experiment_id' => 102],
            ['name' => 'Voltmeter', 'quantity' => '1','experiment_id' => 102],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 102],
            ['name' => 'Rheostat', 'quantity' => '1','experiment_id' => 102],

             //*Biology Form 4 Activity 1.1
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 103],

            //*Biology Form 4 Activity 2.1
            ['name' => 'Glass Slide', 'quantity' => '1','experiment_id' => 104],
            ['name' => 'Cover Slip', 'quantity' => '1','experiment_id' => 104],
            ['name' => 'Light Microscope', 'quantity' => '1','experiment_id' => 104],
            ['name' => 'Scalpel', 'quantity' => '1','experiment_id' => 104],
            ['name' => 'Forcep', 'quantity' => '1','experiment_id' => 104],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 104],
            ['name' => 'Mounting Needle', 'quantity' => '1','experiment_id' => 104],

            //*Biology Form 4 Activity 2.2
            ['name' => 'Glass Slide', 'quantity' => '1','experiment_id' => 105],
            ['name' => 'Cover Slip', 'quantity' => '1','experiment_id' => 105],
            ['name' => 'Light Microscope', 'quantity' => '1','experiment_id' => 105],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 105],
            ['name' => 'Mounting Needle', 'quantity' => '1','experiment_id' => 105],
            
            //*Biology Form 4 Activity 3.1
            ['name' => 'beaker', 'quantity' => '1','experiment_id' => 106],
            ['name' => 'Test Tube', 'quantity' => '1','experiment_id' => 106],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 106],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 106],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 106],

            //*Biology Form 4 Activity 3.2
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 107],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 107],
            ['name' => '25 cm Capillary Tube', 'quantity' => '1','experiment_id' => 107],
            ['name' => 'Syringe', 'quantity' => '1','experiment_id' => 107],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 107],
            ['name' => '50 mL Beaker', 'quantity' => '1','experiment_id' => 107],
            ['name' => 'Marker Pen', 'quantity' => '1','experiment_id' => 107],
            ['name' => 'Scissor', 'quantity' => '1','experiment_id' => 107],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 107],

             //*Biology Form 4 Activity 3.3
            ['name' => 'Light Microscope', 'quantity' => '1','experiment_id' => 108],
            ['name' => 'Glass Slide', 'quantity' => '1','experiment_id' => 108],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 108],
            ['name' => 'Mounting Needle', 'quantity' => '1','experiment_id' => 108],
            ['name' => 'Cover Slip', 'quantity' => '1','experiment_id' => 108],

             //*Biology Form 4 Activity 3.4
            ['name' => 'Light Microscope', 'quantity' => '1','experiment_id' => 109],
            ['name' => 'Glass Slide', 'quantity' => '1','experiment_id' => 109],
            ['name' => 'Cover Slip', 'quantity' => '1','experiment_id' => 109],
            ['name' => 'Small Knife', 'quantity' => '1','experiment_id' => 109],
            ['name' => 'Mounting Needle', 'quantity' => '1','experiment_id' => 109],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 109],
            ['name' => 'Forcep', 'quantity' => '1','experiment_id' => 109],

            //*Biology Form 4 Activity 3.5
            ['name' => 'Test Tube', 'quantity' => '1','experiment_id' => 110],
            ['name' => 'Cork Borer', 'quantity' => '1','experiment_id' => 110],
            ['name' => 'Knife', 'quantity' => '1','experiment_id' => 110],
            ['name' => 'Forcep', 'quantity' => '1','experiment_id' => 110],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 110],
            ['name' => '50 cm³ Beaker', 'quantity' => '1','experiment_id' => 110],
            ['name' => '100 cm³ Measuring Cylinder', 'quantity' => '1','experiment_id' => 110],
            ['name' => 'Test Tube Rack', 'quantity' => '2','experiment_id' => 110],
            ['name' => 'Electronic Weighing Scale ', 'quantity' => '1','experiment_id' => 110],

            //*Biology Form 4 Activity 3.6
            ['name' => 'Knife', 'quantity' => '1','experiment_id' => 111],
            ['name' => 'Bottle', 'quantity' => '1','experiment_id' => 111],
            ['name' => 'Oven', 'quantity' => '1','experiment_id' => 111],

            //*Biology Form 4 Activity 5.1
            ['name' => 'Beaker', 'quantity' => '1','experiment_id' => 112],
            ['name' => 'Test Tube', 'quantity' => '10','experiment_id' => 112],
            ['name' => 'Syringe', 'quantity' => '2','experiment_id' => 112],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 112],
            ['name' => 'Glass Rod', 'quantity' => '1','experiment_id' => 112],
            ['name' => 'White Grooved Tile', 'quantity' => '1','experiment_id' => 112],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 112],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 112],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 112],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 112],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 112],
            ['name' => 'Measuring Cylinder', 'quantity' => '1','experiment_id' => 112],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 112],

            //*Biology Form 4 Activity 5.2
            ['name' => 'Beaker', 'quantity' => '1','experiment_id' => 113],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 113],
            ['name' => 'Thermometer', 'quantity' => '2','experiment_id' => 113],
            ['name' => 'Test Tube', 'quantity' => '3','experiment_id' => 113],
            ['name' => '5 mL Syringe (Without Needle)', 'quantity' => '1','experiment_id' => 113],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 113],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 113],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 113],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 113],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 113],

            //*Biology Form 4 Activity 7.1
            ['name' => 'Boiling Tube', 'quantity' => '2','experiment_id' => 114],
            ['name' => 'Screw Clip', 'quantity' => '2','experiment_id' => 114],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 114],
            ['name' => '250 mL Beaker', 'quantity' => '3','experiment_id' => 114],
            ['name' => 'Capilary Tube', 'quantity' => '2','experiment_id' => 114],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 114],
            ['name' => 'Rubber Tube', 'quantity' => '2','experiment_id' => 114],
            ['name' => 'Water Bath', 'quantity' => '1','experiment_id' => 114],

            //*Biology Form 4 Activity 7.3
            ['name' => 'Boiling Tube', 'quantity' => '2','experiment_id' => 115],
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 115],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 115],
            ['name' => 'Measuring Cylinder', 'quantity' => '2','experiment_id' => 115],
            ['name' => 'Delivery Tube', 'quantity' => '2','experiment_id' => 115],
            ['name' => 'Cork', 'quantity' => '4','experiment_id' => 115],

            //*Biology Form 4 Activity 9.1
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 116],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 116],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 116],
            ['name' => '500 mL Beaker', 'quantity' => '1','experiment_id' => 116],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 116],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 116],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 116],
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 116],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 116],
            ['name' => 'Glass Rod', 'quantity' => '1','experiment_id' => 116],
            ['name' => 'Measuring Cylinder', 'quantity' => '1','experiment_id' => 116],

            //*Biology Form 4 Activity 9.2
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 117],
            ['name' => 'Measuring Cylinder', 'quantity' => '1','experiment_id' => 117],
            ['name' => '500 mL Beaker', 'quantity' => '1','experiment_id' => 117],
            ['name' => 'Water Bath', 'quantity' => '1','experiment_id' => 117],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 117],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 117],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 117],

            //*Biology Form 4 Activity 9.3
            ['name' => 'Test Tube', 'quantity' => '2','experiment_id' => 118],
            ['name' => 'Test Tube Holder', 'quantity' => '1','experiment_id' => 118],
            ['name' => 'Water Bath', 'quantity' => '1','experiment_id' => 118],
            ['name' => '1 mL Syringe', 'quantity' => '1','experiment_id' => 118],
            ['name' => 'Dropper', 'quantity' => '1','experiment_id' => 118],
            ['name' => 'Stopper', 'quantity' => '2','experiment_id' => 118],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 118],

            //*Biology Form 4 Activity 9.4
            ['name' => 'Retort Stand', 'quantity' => '1','experiment_id' => 119],
            ['name' => 'Clamp', 'quantity' => '2','experiment_id' => 119],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 119],
            ['name' => 'Boiling Tube', 'quantity' => '1','experiment_id' => 119],
            ['name' => 'Needle', 'quantity' => '1','experiment_id' => 119],
            ['name' => 'Electronic Weighing Scale ', 'quantity' => '1','experiment_id' => 119],
            ['name' => 'Measuring Cylinder', 'quantity' => '1','experiment_id' => 119],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 119],

            //*Biology Form 4 Activity 9.5
            ['name' => '1 mL Syringe Needle', 'quantity' => '1','experiment_id' => 120],
            ['name' => '5 mL Syringe Needle', 'quantity' => '2','experiment_id' => 120],
            ['name' => 'Knife', 'quantity' => '1','experiment_id' => 120],
            ['name' => '50 mL Beaker', 'quantity' => '1','experiment_id' => 120],
            ['name' => 'Specimen Tube', 'quantity' => '1','experiment_id' => 120],
            ['name' => 'Juicer', 'quantity' => '1','experiment_id' => 120],
            ['name' => 'Sieve', 'quantity' => '1','experiment_id' => 120],
           
            //*Biology Form 4 Activity 9.6
            ['name' => 'Specimen Tube', 'quantity' => '1','experiment_id' => 121],
            ['name' => 'Knife', 'quantity' => '1','experiment_id' => 121],
            ['name' => '1 mL Syringe Needle', 'quantity' => '1','experiment_id' => 121],
            ['name' => '5 mL Syringe Needle', 'quantity' => '1','experiment_id' => 121],
            ['name' => '50 mL Beaker', 'quantity' => '1','experiment_id' => 121],
            ['name' => '100 mL Beaker', 'quantity' => '1','experiment_id' => 121],
            ['name' => 'Bunsen Burner', 'quantity' => '1','experiment_id' => 121],
            ['name' => 'Tripod Stand', 'quantity' => '1','experiment_id' => 121],
            ['name' => 'Sieve', 'quantity' => '1','experiment_id' => 121],
            ['name' => 'Wire Gauze', 'quantity' => '1','experiment_id' => 121],

            //*Biology Form 4 Activity 13.1
            ['name' => 'Cup', 'quantity' => '4','experiment_id' => 122],
            ['name' => 'Beaker', 'quantity' => '1','experiment_id' => 122],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 122],
            ['name' => 'Measuring Cylinder', 'quantity' => '1','experiment_id' => 122],

            //*Biology Form 5 Experiment 1.1
            ['name' => 'Nursery Box', 'quantity' => '1','experiment_id' => 123],
            ['name' => 'Electronic Balance', 'quantity' => '1','experiment_id' => 123],
            ['name' => 'Oven', 'quantity' => '1','experiment_id' => 123],
         
            //*Biology Form 5 Experiment 1.2
            ['name' => 'Classical Music', 'quantity' => '1','experiment_id' => 124],
            ['name' => 'Heavy Metal Music', 'quantity' => '1','experiment_id' => 124],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 124],

            //*Biology Form 5 Experiment 2.1
            ['name' => 'Colourless Nail Polish', 'quantity' => '1','experiment_id' => 125],
            ['name' => 'Magnifying Glass', 'quantity' => '1','experiment_id' => 125],
            ['name' => 'Forcep', 'quantity' => '1','experiment_id' => 125],
            ['name' => 'Glass Slide', 'quantity' => '1','experiment_id' => 125],
            ['name' => 'Cover Slip', 'quantity' => '1','experiment_id' => 125],
            ['name' => 'Light Microscope', 'quantity' => '1','experiment_id' => 125],
            
            //*Biology Form 5 Experiment 2.2
            ['name' => 'Cork', 'quantity' => '1','experiment_id' => 126],
            ['name' => 'Beaker', 'quantity' => '1','experiment_id' => 126],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 126],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 126],
            ['name' => 'Electrical Table Fan', 'quantity' => '1','experiment_id' => 126],
            ['name' => '100 W Bulb', 'quantity' => '1','experiment_id' => 126],
            ['name' => 'Capillary Tube', 'quantity' => '1','experiment_id' => 126],
            ['name' => 'Screw Clip', 'quantity' => '1','experiment_id' => 126],

            //*Biology Form 5 Experiment 2.3
            ['name' => 'Scissor', 'quantity' => '1','experiment_id' => 127],
            ['name' => '60 W Bulb', 'quantity' => '1','experiment_id' => 127],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 127],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 127],
            ['name' => 'Paper Clip', 'quantity' => '1','experiment_id' => 127],
            ['name' => 'Boiling Tube', 'quantity' => '1','experiment_id' => 127],
            ['name' => 'Measuring Cylinder', 'quantity' => '1','experiment_id' => 127],
            ['name' => 'Retord Stand', 'quantity' => '1','experiment_id' => 127],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 127],
            ['name' => 'Thermometer', 'quantity' => '1','experiment_id' => 127],
            ['name' => 'Beaker', 'quantity' => '1','experiment_id' => 127],

            //*Biology Form 5 Experiment 2.4
            //*None

            //*Biology Form 5 Experiment 3.1
            ['name' => 'Culture Bottle', 'quantity' => '5','experiment_id' => 129],
            ['name' => 'L Shape Delivery Tube', 'quantity' => '1','experiment_id' => 129],
            ['name' => 'Cork', 'quantity' => '1','experiment_id' => 129],
            ['name' => 'Air Pump', 'quantity' => '1','experiment_id' => 129],

            //*Biology Form 5 Experiment 4.1
            ['name' => 'Knife', 'quantity' => '1','experiment_id' => 130],
            ['name' => 'Rubber Tube', 'quantity' => '1','experiment_id' => 130],
            ['name' => 'Retord Stand', 'quantity' => '1','experiment_id' => 130],
            ['name' => 'Clamp', 'quantity' => '1','experiment_id' => 130],
            ['name' => 'Marker Pen', 'quantity' => '1','experiment_id' => 130],
            ['name' => 'Water Manometer', 'quantity' => '1','experiment_id' => 130],

            //*Biology Form 5 Experiment 4.2
            ['name' => 'Open Bottle', 'quantity' => '1','experiment_id' => 131],
            ['name' => 'Side Tube', 'quantity' => '1','experiment_id' => 131],
            ['name' => 'Cork', 'quantity' => '1','experiment_id' => 131],
            ['name' => 'Marker Pen', 'quantity' => '1','experiment_id' => 131],

            //*Biology Form 5 Experiment 4.3
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 132],
            ['name' => 'Knife', 'quantity' => '1','experiment_id' => 132],

            //*Biology Form 5 Experiment 4.4
            ['name' => '5 Litre Glass Container', 'quantity' => '2','experiment_id' => 133],

            //*Biology Form 5 Experiment 4.5
            ['name' => '100 mL Beaker', 'quantity' => '1','experiment_id' => 134],
            ['name' => 'Oven', 'quantity' => '1','experiment_id' => 134],

            //*Biology Form 5 Experiment 5.1
            //*None

            //*Biology Form 5 Experiment 5.2
            //*None

            //*Biology Form 5 Experiment 9.1
            ['name' => 'Plastic Tray', 'quantity' => '3','experiment_id' => 137],
            ['name' => 'Ruler', 'quantity' => '1','experiment_id' => 137],
            ['name' => 'Mini Shovel', 'quantity' => '1','experiment_id' => 137],

             //*Biology Form 5 Experiment 10.1
            ['name' => 'Reagent Bottle', 'quantity' => '2','experiment_id' => 138],
            ['name' => '1 mL Syringe With Needle', 'quantity' => '1','experiment_id' => 138],
            ['name' => 'Stopwatch', 'quantity' => '1','experiment_id' => 138],
            ['name' => 'Marker Pen', 'quantity' => '1','experiment_id' => 138],
            ['name' => 'Measuring Cylinder', 'quantity' => '1','experiment_id' => 138],

            //*Biology Form 5 Experiment 12.1
            ['name' => 'Height Measuring Equipment', 'quantity' => '1','experiment_id' => 139],
            ['name' => 'Weighing Machine', 'quantity' => '1','experiment_id' => 139],
            ['name' => 'Ink Pad', 'quantity' => '1','experiment_id' => 139],


        ];
        foreach ($apparatus as $item) {
            Defaultapparatus::create($item);
        }
    }
}
