<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'weighting',
        'github',
        'link',
        'description'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contactsDuties(): HasMany
    {
        return $this->hasMany(ContactDuty::class);
    }

    public function jirisProjects(): HasMany
    {
        return $this->hasMany(JiriProject::class);
    }
}
