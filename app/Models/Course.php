<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    public $casts = [
        'learnings' => 'array'
    ];

    public function scopeReleased(Builder $query): Builder
    {
        return $query->whereNotNull('released_at');
    }

    /**
     * Relationship
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}