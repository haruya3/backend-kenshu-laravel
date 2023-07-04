<?php
namespace App\Entity;

readonly class Tag
{
    public function __construct(
        public int $id,
        public string $name,
    ){}
}
