<?php
namespace App\Entity;

readonly class User
{
    function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $password,
        public string $profile_image_url
    ){}
}
