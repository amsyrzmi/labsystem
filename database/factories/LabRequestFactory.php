<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Experiment;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LabRequest>
 */
class LabRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a random experiment and work backwards to get topic and subject
        $experiment = Experiment::inRandomOrder()->first();
        $topic = $experiment ? $experiment->topic()->first() : Topic::inRandomOrder()->first();
        $subject = $topic ? $topic->subject()->first() : Subject::inRandomOrder()->first();

        // Generate a random date between 3 and 10 days from now (matching your form logic)
        $preferredDate = $this->faker->dateTimeBetween('+3 days', '+10 days');

        // Determine status with realistic weights
        $status = $this->faker->randomElement([
            'pending',   
            'pending',   
            'approved',  
            'approved',
            'rejected',  
        ]);

        // If rejected, add rejection reason
        $rejectionReason = null;
        if ($status === 'rejected') {
            $rejectionReason = $this->faker->randomElement([
                'Lab equipment not available on selected date',
                'Insufficient materials in stock',
                'Lab already booked for that time slot',
                'Request submitted too late',
                'Conflicting schedule with other classes',
            ]);
        }

        // if completed,set completed_at to past date
        $completedAt = null;
        if ($status === 'completed') {
            $completedAt = $this->faker->dateTimeBetween('-30 days', '-1 day');
        }

        // Generate realistic lab times (school hours: 8 AM - 5 PM)
        $hour = $this->faker->numberBetween(8, 16); 
        $minute = $this->faker->randomElement(['00', '30']); 
        $preferredTime = sprintf('%02d:%s:00', $hour, $minute);

        // Get only teachers (assuming role='teacher')
        $teacherId = User::where('role', 'teacher')->inRandomOrder()->value('id');

        return [
            'user_id' => $teacherId ?: User::inRandomOrder()->value('id'),
            'form_level' => $this->faker->randomElement(['form 1', 'form 2', 'form 3', 'form 4', 'form 5']),
            'subject_id' => $subject ? $subject->id : null,
            'topic_id' => $topic ? $topic->id : null,
            'experiment_id' => $experiment ? $experiment->id : null,
            'num_students' => $this->faker->numberBetween(15, 40), // More realistic class sizes
            'group_size' => $this->faker->numberBetween(2, 6), // Typical lab group sizes
            'preferred_date' => $preferredDate->format('Y-m-d'),
            'preferred_time' => $preferredTime,
            'additional_notes' => $this->faker->optional(0.3)->sentence(), // 30% chance of having notes
            'classname' => $this->faker->randomElement(['1A', '1B', '1C', '2A', '2B', '2C', '3A', '3B', '3C', '4A', '4B', '4C', '5A', '5B', '5C']),
            'lab_number' => 'Lab ' . $this->faker->numberBetween(1, 5), // Assuming 5 labs
            'repetition' => $this->faker->numberBetween(1, 3), // Most experiments 1-3 repetitions
            'status' => $status,
            'rejection_reason' => $rejectionReason,
            'completed_at' => $completedAt,
        ];
    }

    
     // create a pending request (upcoming dates)
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'rejection_reason' => null,
            'completed_at' => null,
            'preferred_date' => $this->faker->dateTimeBetween('+3 days', '+10 days')->format('Y-m-d'),
        ]);
    }

    //create approved requests
    public function approved(): static
    {
        $preferredDate = $this->faker->dateTimeBetween('+3 days', '+10 days');
        
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'rejection_reason' => null,
            'completed_at' => null,
            'preferred_date' => $preferredDate->format('Y-m-d'),
            'approved_date' => $preferredDate->format('Y-m-d'), // Same as preferred
            'approved_time' => $attributes['preferred_time'],
            'approved_at' => now(),
        ]);
    }


    //create rejected request
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'rejection_reason' => $this->faker->randomElement([
                'Lab equipment not available on selected date',
                'Insufficient materials in stock',
                'Lab already booked for that time slot',
                'Request submitted too late',
            ]),
            'completed_at' => null,
        ]);
    }

    /**
     * Create a completed request (historical)
     */
    public function completed(): static
    {
        $completedDate = $this->faker->dateTimeBetween('-60 days', '-1 day');
        
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'rejection_reason' => null,
            'preferred_date' => $completedDate->format('Y-m-d'),
            'completed_at' => $completedDate,
        ]);
    }

    /**
     * Create a cancelled request
     */
    public function cancelled(): static
    {
        $preferredDate = $this->faker->dateTimeBetween('-30 days', '-1 days');
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
            'rejection_reason' => 'Teacher cancelled the request',
            'preferred_date' => $preferredDate->format('Y-m-d'),
            'completed_at' => null,
        ]);
    }

    /**
     * Create a no-show request
     */
    public function noShow(): static
    {
        $noShowDate = $this->faker->dateTimeBetween('-30 days', '-1 day');
        
        return $this->state(fn (array $attributes) => [
            'status' => 'no_show',
            'rejection_reason' => 'Teacher did not show up for scheduled session',
            'preferred_date' => $noShowDate->format('Y-m-d'),
            'completed_at' => null,
        ]);
    }
}