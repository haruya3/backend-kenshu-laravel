<?php
namespace App\Repositries\Posts;

use App\Models\Image;

class ImageRepository implements ImageRepositoryInterface
{
    /**
     * @param int $post_id
     * @return \App\Entity\Image[]
     */
    public function findFromPost(int $post_id): array
    {
        $imageItems = Image::where('post_id', $post_id)->get();
        if($imageItems === []) return [];

        return $imageItems->map(function ($imageItem){
            return new \App\Entity\Image(
                id: $imageItem->id,
                image_url: $imageItem->image_url,
                post_id: $imageItem->post_id,
            );
        })->toArray();
    }

    public function createByPost(\App\Entity\Image $image): bool
    {
        return true;
    }
}
