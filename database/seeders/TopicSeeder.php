<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $Chemistry_topics = [
            //?Chemistry Form 4 Topics
            ['name' => 'Introduction to Chemistry', 'subject_id' => 2],
            ['name' => 'Matter and Atomic Structure', 'subject_id' => 2],
            ['name' => 'Mole Concept, Chemical Formulae & Equations', 'subject_id' => 2],
            ['name' => 'Periodic Table of Elements', 'subject_id' => 2],
            ['name' => 'Chemical Bonding', 'subject_id' => 2],
            ['name' => 'Acids, Bases and Salts', 'subject_id' => 2],
            ['name' => 'Rate of Reaction ', 'subject_id' => 2],
            ['name' => 'Manufactured Substances in Industry', 'subject_id' => 2],

            //?Chemistry Form 5 Topics
            ['name' => 'Redox Equilibrium', 'subject_id' => 6],
            ['name' => 'Carbon Compounds', 'subject_id' => 6],
            ['name' => 'Thermochemistry', 'subject_id' => 6],
            ['name' => 'Polymers', 'subject_id' => 6],
            ['name' => 'Consumer & Industrial Chemistry', 'subject_id' => 6],
        ];

        $Physics_topics = [
            //?Physics Form 4 Topics
            ['name' => 'Measurement', 'subject_id' => 1],
            ['name' => 'Force and Motion', 'subject_id' => 1],
            ['name' => 'Gravitation', 'subject_id' => 1],
            ['name' => 'Heat', 'subject_id' => 1],
            ['name' => 'Waves', 'subject_id' => 1],
            ['name' => 'Light & Optics', 'subject_id' => 1],

            //?Physics Form 5 Topics
            ['name' => 'Force and Motion II', 'subject_id' => 5],
            ['name' => 'Pressure', 'subject_id' => 5],
            ['name' => 'Electricity', 'subject_id' => 5],
            ['name' => 'Electromagnetism', 'subject_id' => 5],
            ['name' => 'Electronics', 'subject_id' => 5],
            ['name' => 'Nuclear & Quantum Physics', 'subject_id' => 5],
        ];

        $Biology_topics = [
            //?Biology Form 4 Topics
            ['name' => 'Introduction to Biology and Laboratory Rules', 'subject_id' => 3],
            ['name' => 'Cell Biology and Organisation', 'subject_id' => 3],
            ['name' => 'Movement of Substances Across the Plasma Membrane', 'subject_id' => 3],
            ['name' => 'Chemical Composition of the Cell', 'subject_id' => 3],
            ['name' => 'Metabolism and Enzymes', 'subject_id' => 3],
            ['name' => 'Cell Division', 'subject_id' => 3],
            ['name' => 'Cellular Respiration', 'subject_id' => 3],
            ['name' => 'Respiratory Systems in Humans and Animals', 'subject_id' => 3],
            ['name' => 'Nutrition and Human Digestive System', 'subject_id' => 3],
            ['name' => 'Transport in Humans and Animals', 'subject_id' => 3],
            ['name' => 'Immunity in Humans', 'subject_id' => 3],
            ['name' => 'Coordination and Response in Humans', 'subject_id' => 3],
            ['name' => 'Homeostasis and Human Urinary System', 'subject_id' => 3],
            ['name' => 'Support and Movement in Humans and Animals', 'subject_id' => 3],
            ['name' => 'Sexual Reproduction,Development and Growth', 'subject_id' => 3],

            //?Biology Form 5 Topics
            ['name' => 'Organisation of Plant tissues and Growth', 'subject_id' => 7],
            ['name' => 'Leaf Structure and Function', 'subject_id' => 7],
            ['name' => 'Nutrition in Plants', 'subject_id' => 7],
            ['name' => 'Transport in Plants', 'subject_id' => 7],
            ['name' => 'Response in Plants', 'subject_id' => 7],
            ['name' => 'Sexual Reproduction in Flowering Plants', 'subject_id' => 7],
            ['name' => 'Biodiversity', 'subject_id' => 7],
            ['name' => 'Ecosystem', 'subject_id' => 7],
            ['name' => 'Environmental Sustainability', 'subject_id' => 7],
            ['name' => 'Inheritance', 'subject_id' => 7],
            ['name' => 'Variation', 'subject_id' => 7],
            ['name' => 'Genetic Technology', 'subject_id' => 7],

        ];

        $Science_topics = [
            //?Science Form 4 Topics
            ['name' => 'Safety Measures in the Laboratory', 'subject_id' => 4],
            ['name' => 'Emergency Help', 'subject_id' => 4],
            ['name' => 'Body Health Measurement Techniques', 'subject_id' => 4],
            ['name' => 'Green Technology for Environmental Sustainability', 'subject_id' => 4],
            ['name' => 'Genetics', 'subject_id' => 4],
            ['name' => 'Support,Movement and Growth', 'subject_id' => 4],
            ['name' => 'Body Coordination', 'subject_id' => 4],
            ['name' => 'Elements and Substances', 'subject_id' => 4],
            ['name' => 'Chemicals in Industry', 'subject_id' => 4],
            ['name' => 'Chemicals in Medicine and Health', 'subject_id' => 4],
            ['name' => 'Force and Motion', 'subject_id' => 4],
            ['name' => 'Nuclear Energy', 'subject_id' => 4],

            //?Science Form 5 Topics
            ['name' => 'Microorganisms', 'subject_id' => 8],
            ['name' => 'Nutrition and Food technology', 'subject_id' => 8],
            ['name' => 'Sustainability of the Environment', 'subject_id' => 8],
            ['name' => 'Rate of Reaction', 'subject_id' => 8],
            ['name' => 'Carbon Compounds', 'subject_id' => 8],
            ['name' => 'Electrochemistry', 'subject_id' => 8],
            ['name' => 'Light and Optics', 'subject_id' => 8],
            ['name' => 'Force and Pressure', 'subject_id' => 8],
            ['name' => 'Space Technology', 'subject_id' => 8],

            //?Science Form 1 Topics
            ['name' => 'Introduction to Scientific Investigation', 'subject_id' => 9],
            ['name' => 'Cell as the Basic Unit of Life', 'subject_id' => 9],
            ['name' => 'Coordination and Response', 'subject_id' => 9],
            ['name' => 'Reproduction', 'subject_id' => 9],
            ['name' => 'Matter', 'subject_id' => 9],
            ['name' => 'Periodic Table', 'subject_id' => 9],
            ['name' => 'Air', 'subject_id' => 9],
            ['name' => 'Light and Optics', 'subject_id' => 9],
            ['name' => 'Earth', 'subject_id' => 9],

            //?Science Form 2 Topics
            ['name' => 'Biodiversity', 'subject_id' => 10],
            ['name' => 'Ecosystem', 'subject_id' => 10],
            ['name' => 'Nutrition', 'subject_id' => 10],
            ['name' => 'Human Health', 'subject_id' => 10],
            ['name' => 'Water and Solution', 'subject_id' => 10],
            ['name' => 'Acids and Alkalis', 'subject_id' => 10],
            ['name' => 'Electricity and Magnetism', 'subject_id' => 10],
            ['name' => 'Magnetism', 'subject_id' => 10],
            ['name' => 'Force and Motion', 'subject_id' => 10],
            ['name' => 'Heat', 'subject_id' => 10],
            ['name' => 'Sound Waves', 'subject_id' => 10],
            ['name' => 'Stars and Galaxies in the Universe', 'subject_id' => 10],
            ['name' => 'Solar System', 'subject_id' => 10],
            ['name' => 'Meteoroid,Asteroid, and Comets', 'subject_id' => 10],

            //?Science Form 3 Topics
            ['name' => 'Stimuli and Responses', 'subject_id' => 11],
            ['name' => 'Respiration', 'subject_id' => 11],
            ['name' => 'Transportation', 'subject_id' => 11],
            ['name' => 'Reactivity of Metals', 'subject_id' => 11],
            ['name' => 'Thermochemistry', 'subject_id' => 11],
            ['name' => 'Electricity and Magnetism', 'subject_id' => 11],
            ['name' => 'Energy and Power', 'subject_id' => 11],
            ['name' => 'Radioactivity', 'subject_id' => 11],
            ['name' => 'Space Weather', 'subject_id' => 11],
            ['name' => 'Space Exploration', 'subject_id' => 11],

        ];

        foreach ($Chemistry_topics as $topic) {
            Topic::create($topic);
        }

        foreach ($Physics_topics as $topic) {
            Topic::create($topic);
        }
        foreach ($Biology_topics as $topic) {
            Topic::create($topic);
        }
        foreach ($Science_topics as $topic) {
            Topic::create($topic);
        }
    }
}
