<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Grade extends Model
{
    public function gemstones(): BelongsToMany
    {
        return $this->belongsToMany(Gemstone::class);
                
    }
}
