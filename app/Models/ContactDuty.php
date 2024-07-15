<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactDuty extends Model
{
    use HasFactory;

    protected $fillable = [
        'urls',
        'tasks',
        'points',
        'contact_id',
        'jiri_id',
        'project_id',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function jiri(): BelongsTo
    {
        return $this->belongsTo(Jiri::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function jiriProject()
    {
        return $this->belongsTo(JiriProject::class, 'jiri_project_id');
    }
}
