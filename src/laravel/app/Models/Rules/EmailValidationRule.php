<?php
namespace App\Models\Rules;

use App\Models\User;
use Illuminate\Validation\Rule;

trait EmailValidationRule
{
    /**
     * @return array
     */
    protected static function emailRules(): array
    {
        return ['required', 'string', 'email', 'max:255', Rule::unique(User::class)];
    }
}
