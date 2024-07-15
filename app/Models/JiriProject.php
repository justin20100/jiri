<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JiriProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'jiri_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function jiri()
    {
        return $this->belongsTo(Jiri::class);
    }

    public function contactDuties(): HasMany
    {
        return $this->hasMany(ContactDuty::class);
    }
}
