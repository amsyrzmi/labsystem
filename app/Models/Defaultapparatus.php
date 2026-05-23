<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Experiment;

class defaultapparatus extends Model
{
    protected $fillable = ['name', 'quantity','experiment_id'];

    public function experiment() : BelongsTo
    {
        return $this->belongsTo(Experiment::class);
    }
}
