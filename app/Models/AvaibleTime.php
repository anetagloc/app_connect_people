<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaibleTime extends Model
{
    /** @use HasFactory<\Database\Factories\AvaibleTimeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
