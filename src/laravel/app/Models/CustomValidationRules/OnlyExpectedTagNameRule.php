<?php
namespace App\Models\CustomValidationRules;

use App\Models\Tag;
use Illuminate\Contracts\Validation\Rule;

class OnlyExpectedTagNameRule implements Rule
{
    public function passes($attribute, $value)
    {
        return in_array($value, Tag::TAG_NAME_LIST);
    }

    public function message()
    {
        return '存在するタグを入力してください。';
    }
}
