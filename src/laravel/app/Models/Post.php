<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'content',
        'thumnail_url',
        'user_id',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function images(): HasMany
    {
        return $this->hasMany('\App\Models\Image');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('\App\Models\Tag');
    }
}
