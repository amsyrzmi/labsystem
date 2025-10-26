<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LabRequest extends Model
{
    use HasFactory; 
    protected $fillable = [
        'user_id',
        'form_level',
        'subject_id',
        'topic_id',
        'experiment_id',
        'num_students',
        'group_size',
        'classname',
        'lab_number',
        'repetition',
        'preferred_date',
        'preferred_time',
        'approved_date',      // NEW
        'approved_time',      // NEW
        'duration',           // NEW
        'approved_at',        // NEW
        'additional_notes',
        'status',
        'completed_at',
        'rejection_reason',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'approved_date' => 'date',     
        'completed_at' => 'datetime',
        'approved_at' => 'datetime',   
        'duration' => 'integer',           
        'num_students' => 'integer',       
        'group_size' => 'integer',         
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function experiment()
    {
        return $this->belongsTo(Experiment::class);
    }

    // Helper method to get final scheduled date/time
    public function getScheduledDateAttribute()
    {
        return $this->approved_date ?? $this->preferred_date;
    }

    public function getScheduledTimeAttribute()
    {
        return $this->approved_time ?? $this->preferred_time;
    }

    // Check if this request conflicts with another
    public function hasConflict($date, $time, $labNumber, $duration, $excludeId = null)
    {
        $startTime = Carbon::parse($time);
        $endTime = $startTime->copy()->addMinutes((int) $duration); // Cast here too as safety

        return self::where('lab_number', $labNumber)
            ->where('status', 'approved')
            ->where('approved_date', $date)
            ->when($excludeId, function($query, $excludeId) {
                return $query->where('id', '!=', $excludeId);
            })
            ->get()
            ->filter(function($request) use ($startTime, $endTime) {
                $reqStart = Carbon::parse($request->approved_time);
                $reqEnd = $reqStart->copy()->addMinutes((int) $request->duration); // Cast here
                
                return $startTime->lt($reqEnd) && $endTime->gt($reqStart);
            })
            ->isNotEmpty();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'approved']);
    }

    public function scopeHistory($query)
    {
        return $query->whereIn('status', ['completed', 'cancelled', 'no_show']);
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'approved')
                     ->whereNotNull('approved_date')
                     ->whereNotNull('approved_time');
    }
    
}