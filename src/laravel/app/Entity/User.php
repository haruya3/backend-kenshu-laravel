<?php
namespace App\Entity;

class User
{
    public readonly int $id;
    public readonly string $name;
    public readonly string $email;
    public readonly string $password;
    public readonly string $profile_image_url;

    function __construct(
        int $id,
        string $name,
        string $email,
        string $password,
        string $profile_image_url
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->profile_image_url = $profile_image_url;
    }
}
