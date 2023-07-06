<?php
namespace App\Models\Rules;

use App\Models\CustomValidationRules\OnlyExpectedTagNameRule;

trait TagNameValidationRules
{
    protected static function tagNameRules(): array
    {
        return ['string', new OnlyExpectedTagNameRule()];
    }
}
