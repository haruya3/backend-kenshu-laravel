<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'image_url',
        'post_id',
    ];

    public function posts(): BelongsTo
    {
        return $this->belongsTo('\App\Models\Post');
    }
}
