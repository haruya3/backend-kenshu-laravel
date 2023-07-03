<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'content',
        'thumnail_url',
        'user_id',
    ];
}
