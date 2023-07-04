<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    const CREATED_AT = NULL;
    const UPDATED_AT = NULL;

    protected $fillable = [
        'id',
        'name',
    ];

    public function posts():BelongsToMany
    {
        return $this->belongsToMany('\App\Models\Post');
    }
}
