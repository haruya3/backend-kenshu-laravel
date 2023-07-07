<?php

namespace App\Models;

use App\Models\Rules\ImageUrlValidationRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Validator;

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

    use ImageUrlValidationRules;

    /**
     * @param string $image_url
     * @param int $post_id
     * @return \App\Entity\Image
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function buildValidatedImageEntity(
        string $image_url,
        int $post_id
    ): \App\Entity\Image
    {
        $validatedImageUrl = Validator::make(['image_url' => $image_url], [
            'image_url' => self::imageUrlRules(),
        ])->validate()['image_url'];

        return new \App\Entity\Image(
          id: 0,
          image_url: $validatedImageUrl,
          post_id: $post_id,
        );
    }
}
