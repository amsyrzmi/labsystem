<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['name' => 'Physics','form_level' => 'form 4'],
            ['name' => 'Chemistry', 'form_level' => 'form 4'],
            ['name' => 'Biology', 'form_level' => 'form 4'],
            ['name' => 'Science', 'form_level' => 'form 4'],
            ['name' => 'Physics','form_level' => 'form 5'],
            ['name' => 'Chemistry', 'form_level' => 'form 5'],
            ['name' => 'Biology', 'form_level' => 'form 5'],
            ['name' => 'Science', 'form_level' => 'form 5'],
            ['name' => 'Science', 'form_level' => 'form 1'],
            ['name' => 'Science', 'form_level' => 'form 2'],
            ['name' => 'Science', 'form_level' => 'form 3'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
