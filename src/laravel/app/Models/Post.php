<?php

namespace App\Models;

use App\Models\Rules\ContentValidationRules;
use App\Models\Rules\ImageUrlValidationRules;
use App\Models\Rules\TitleValidationRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Validator;

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

    use TitleValidationRules;
    use ContentValidationRules;
    use ImageUrlValidationRules;
    /**
     * @param string $title
     * @param string $content
     * @param string $thumnail_image_url
     * @param int $user_id
     * @return \App\Entity\Post
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function buildValidatedPostEntity(
        string $title,
        string $content,
        string $thumnail_image_url,
        int $user_id,
    ): \App\Entity\Post
    {
        $nonValidatedPostParams = [
            'title' => $title,
            'content' => $content,
            'thumnail_image_url' => $thumnail_image_url,
            'user_id' => $user_id,
        ];

        $validatedPostParams = Validator::make($nonValidatedPostParams,[
            'title' => self::titleRules(),
            'content' => self::contentRules(),
            'thumnail_image_url' => self::imageUrlRules(),
        ])->validate();

        return new \App\Entity\Post(
            id: 0,
            title: $validatedPostParams['title'],
            content: $validatedPostParams['content'],
            thumnail_url: $validatedPostParams['thumnail_image_url'],
            user_id: $user_id,
        );
    }

    /**
     * @param int $id
     * @param string $title
     * @param string $content
     * @param int $user_id
     * @return \App\Entity\Post
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function buildValidatedPostEntityForUpdate(
        int $id,
        string $title,
        string $content,
        int $user_id,
    ): \App\Entity\Post
    {
        $nonValidatedPostParams = [
            'title' => $title,
            'content' => $content,
        ];

        $validatedPostParams = Validator::make($nonValidatedPostParams,[
            'title' => self::titleRules(),
            'content' => self::contentRules(),
        ])->validate();

        return new \App\Entity\Post(
            id: $id,
            title: $validatedPostParams['title'],
            content: $validatedPostParams['content'],
            thumnail_url: '',
            user_id: $user_id,
        );
    }
}
