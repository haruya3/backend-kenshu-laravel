<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile_image_url',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    use \App\Models\Rules\PasswordValidationRules;
    /**
     * @param array $input
     * @return \App\Entity\User
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function buildValidatedUserParams(
        string $name,
        string $email,
        string $password,
        string $password_confirmation,
        string $profile_image_url
    ): \App\Entity\User
    {
        $nonValidatedUserParamsbefore = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password_confirmation,
            'profile_image_url' => $profile_image_url,
        ];

        $validatedUserParams = Validator::make($nonValidatedUserParamsbefore, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => self::passwordRules(),
            'profile_image_url' => ['required', 'string', 'max: 500'],
        ])->validate();

        return new \App\Entity\User(
            id: 1,
            name: $validatedUserParams['name'],
            email: $validatedUserParams['email'],
            password: Hash::make($validatedUserParams['password']),
            profile_image_url: $validatedUserParams['profile_image_url'],
        );
    }
}
