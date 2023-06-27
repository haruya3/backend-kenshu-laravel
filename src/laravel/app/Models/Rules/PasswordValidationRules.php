<?php
namespace App\Models\Rules;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected static function passwordRules(): array
    {
        return ['required', 'string', new Password, 'confirmed'];
    }
}
