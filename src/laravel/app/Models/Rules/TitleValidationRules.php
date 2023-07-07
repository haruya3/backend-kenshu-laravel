<?php
namespace App\Models\Rules;

trait TitleValidationRules
{
    protected static function titleRules(): array
    {
        return ['required', 'string', 'max:60', 'regex:/^[( |　)A-Za-z0-9ぁ-ゞァ-ヾ一-龠+]+$/u'];
    }
}
