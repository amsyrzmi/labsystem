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
        //topics chemistry
        $Chemistry_topics = [
            ['name' => 'Introduction to Chemistry', 'subject_id' => 2],
            ['name' => 'Matter and Atomic Structure', 'subject_id' => 2],
            ['name' => 'Mole Concept, Chemical Formulae & Equations', 'subject_id' => 2],
            ['name' => 'Periodic Table of Elements', 'subject_id' => 2],
            ['name' => 'Chemical Bonding', 'subject_id' => 2],
            ['name' => 'Acids, Bases and Salts', 'subject_id' => 2],
            ['name' => 'Rate of Reaction ', 'subject_id' => 2],
            ['name' => 'Manufactured Substances in Industry', 'subject_id' => 2],

            ['name' => 'Redox Equilibrium', 'subject_id' => 6],
            ['name' => 'Carbon Compounds', 'subject_id' => 6],
            ['name' => 'Thermochemistry', 'subject_id' => 6],
            ['name' => 'Polymers', 'subject_id' => 6],
            ['name' => 'Consumer & Industrial Chemistry', 'subject_id' => 6],
        ];

        $Physics_topics = [
            ['name' => 'Measurement', 'subject_id' => 1],
            ['name' => 'Force and Motion', 'subject_id' => 1],
            ['name' => 'Gravitation', 'subject_id' => 1],
            ['name' => 'Heat', 'subject_id' => 1],
            ['name' => 'Waves', 'subject_id' => 1],
            ['name' => 'Light & Optics', 'subject_id' => 1],

            ['name' => 'Force and Motion II', 'subject_id' => 5],
            ['name' => 'Pressure', 'subject_id' => 5],
            ['name' => 'Electricity', 'subject_id' => 5],
            ['name' => 'Electromagnetism', 'subject_id' => 5],
            ['name' => 'Electronics', 'subject_id' => 5],
            ['name' => 'Nuclear & Quantum Physics', 'subject_id' => 5],
        ];

        foreach ($Chemistry_topics as $topic) {
            Topic::create($topic);
        }

        foreach ($Physics_topics as $topic) {
            Topic::create($topic);
        }
    }
}
