<?php
namespace App\Models\Rules;

trait TitleValidationRule
{
    protected static function titleRule(): array
    {
        return ['required', 'string', 'between'];
    }
}
