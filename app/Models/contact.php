<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class contact extends Model
{
    use HasFactory;

    protected   $fillable = [
        'lastname',
        'firstname',
        'email',
        'avatar',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jiris(): BelongsToMany
    {
        return $this
            ->belongsToMany(Jiri::class, 'contact_jiri', 'contact_id', 'jiri_id')
            ->withPivot(['role', 'token']);
    }

    public function projects(): BelongsToMany
    {
        return $this
            ->belongsToMany(Project::class, 'contact_duty', 'contact_id', 'project_id')
            ->withPivot(['urls', 'tasks', 'points']);
    }

    public function contactJiris(): HasMany
    {
        return $this->hasMany(ContactJiri::class);
    }

    public function contactDuties(): HasMany
    {
        return $this->hasMany(ContactDuty::class);
    }
}
