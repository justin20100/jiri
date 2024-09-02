<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jiris(): BelongsToMany
    {
        return $this->belongsToMany(Jiri::class, 'jiri_projects', 'project_id', 'jiri_id');
    }

    public function jirisProjects(): HasMany
    {
        return $this->hasMany(JiriProject::class);
    }

//    public function contactsDuties(): HasMany
//    {
//        return $this->hasMany(ContactDuty::class);
//    }


}
