<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    //

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
