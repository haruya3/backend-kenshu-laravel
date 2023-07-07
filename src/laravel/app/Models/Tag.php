<?php

namespace App\Models;

use App\Models\CustomValidationRules\OnlyExpectedTagNameRule;
use App\Models\Rules\TagNameValidationRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Validator;

class Tag extends Model
{
    /**
     * タグの変更や追加はあまり起きないので定数として定義します。
     * タグの変更や追加があった場合はこちらの定数にも変更や追加をします。
     */
    const TAG_NAME_LIST = [
        '総合',
        'テクノロジー',
        'モバイル',
        'アプリ',
        'エンタメ',
        'ビューティー',
        'ファッション',
        'ライフスタイル',
        'ビジネス',
        'グルメ',
        'スポーツ',
    ];

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

    use TagNameValidationRules;
    /**
     * @param string $tag_name
     * @return \App\Entity\Tag
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function buildValidatedTag(string $tag_name): \App\Entity\Tag
    {
        $validatedTagName = Validator::make(['name' => $tag_name], ['name' => self::tagNameRules()])->validate()['name'];

        return new \App\Entity\Tag(
            id: 0,
            name: $validatedTagName,
        );
    }
}
