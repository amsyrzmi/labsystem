<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class subject extends Model
{
    protected $fillable = ['name', 'form_level'];

    public function topics() :HasMany
    {
        return $this->hasMany(Topic::class);
    }
}
