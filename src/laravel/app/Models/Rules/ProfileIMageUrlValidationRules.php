<?php
namespace App\Models\Rules;

trait ProfileIMageUrlValidationRules
{
    /**
     * @return array
     */
    protected static function profileImageUrlRules(): array
    {
        return ['required', 'string', 'max: 500'];
    }
}
