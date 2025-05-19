<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gemstone extends Model
{
    public function grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class);
    }
    
    // Specify the fields allowed for mass assignment
    protected $fillable = [
        'name',
        'location',
        'colour',
        'association',
        'meaning',
        'grade_id',
    ];
    
}
