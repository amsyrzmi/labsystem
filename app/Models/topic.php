<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class topic extends Model
{
    protected $fillable = ['name', 'subject_id'];

    public function subject() :BelongsTo
    {
        return $this->belongsTo(subject::class);
    }

    public function experiments() :HasMany
    {
        return $this->hasMany(experiment::class);
    }

}
