<?php
namespace App\Models\Rules;

trait ContentValidationRules
{
    protected static function contentRules(): array
    {
        return ['required', 'string', 'max:500', 'regex:/^[( |　)A-Za-z0-9ぁ-ゞァ-ヾ一-龠+]+$/u'];
    }
}
