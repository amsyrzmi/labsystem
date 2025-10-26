<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class experiment extends Model
{
    protected $fillable = ['name', 'topic_id'];

    public function topic() :BelongsTo
    {
        return $this->belongsTo(topic::class);
    }

    public function defaultmaterial() :HasMany
    {
        return $this->hasMany(defaultmaterial::class);
    }

    public function defaultapparatus() :HasMany
    {
        return $this->hasMany(defaultapparatus::class);
    }
    
}
