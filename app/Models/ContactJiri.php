<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactJiri extends Model
{
    use HasFactory;

    protected  $fillable = [
        'role',
        'token',
        'contact_id',
        'jiri_id',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function jiri(): BelongsTo
    {
        return $this->belongsTo(Jiri::class);
    }
}
