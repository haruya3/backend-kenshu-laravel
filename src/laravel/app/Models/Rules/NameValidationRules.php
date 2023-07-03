<?php
namespace App\Models\Rules;

use App\Models\User;
use Illuminate\Validation\Rule;

trait NameValidationRules
{
    const MAX_CHARACTERS = 50;
    /**
     * @return array
     */
    protected static function nameRules(): array
    {
        $maxCharacters = self::MAX_CHARACTERS;
        return [ 'required', 'string', "max:{$maxCharacters}", Rule::unique(User::class), ];
    }
}
