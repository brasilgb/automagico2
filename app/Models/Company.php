<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    //

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
