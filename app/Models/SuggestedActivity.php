<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuggestedActivity extends Model
{
    /** @use HasFactory<\Database\Factories\SuggestedActivityFactory> */
    use HasFactory;

    protected $fillable = [
        'activity_id',
    ];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
