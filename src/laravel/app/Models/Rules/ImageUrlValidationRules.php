<?php
namespace App\Models\Rules;

trait ImageUrlValidationRules
{
    /**
     * @return array
     */
    protected static function imageUrlRules(): array
    {
        return ['required', 'string'];
    }
}
