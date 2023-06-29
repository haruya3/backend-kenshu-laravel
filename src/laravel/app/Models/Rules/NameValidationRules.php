<?php
namespace App\Models\Rules;

use App\Models\User;
use Illuminate\Validation\Rule;

trait NameValidationRules
{
    /**
     * @return array
     */
    protected static function nameRules(): array
    {
        return [ 'required', 'string', 'max:255', Rule::unique(User::class), ];
    }
}
