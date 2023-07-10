<?php
namespace App\Dto;

readonly class StoredImageUrlAboutPostDto
{
    /**
     * @param string $thumnail_image_url
     * @param array<string> $image_urls
     */
    public function __construct(
        public string $thumnail_image_url,
        public array $image_urls,
    ){}
}
