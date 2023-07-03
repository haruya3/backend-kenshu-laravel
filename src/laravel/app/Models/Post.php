<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
