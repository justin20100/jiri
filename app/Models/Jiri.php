<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jiri extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'start',
        'end',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contactDuties(): HasMany
    {
        return $this->hasMany(ContactDuty::class);
    }

    public function jiriProjects(): HasMany
    {
        return $this->hasMany(jiriProject::class);
    }


    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'jiri_project', 'jiri_id', 'project_id');
    }

    public function contactJiris(): HasMany
    {
        return $this->hasMany(ContactJiri::class);
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'contact_jiris', 'jiri_id', 'contact_id');
    }
}
