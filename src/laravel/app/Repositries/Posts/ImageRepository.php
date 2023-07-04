<?php
namespace App\Repositries\Posts;

use App\Models\Image;

class ImageRepository implements ImageRepositoryInterface
{
    /**
     * @param int $post_id
     * @return \App\Entity\Image[] | string
     */
    public function findFromPost(int $post_id): array | string
    {
        $imageItems = Image::where('post_id', $post_id)->get()->toArray();

        if(empty($imageItems)){
            return '';
        }

        return array_map(function ($imageItem){
            return new \App\Entity\Image(
                id: $imageItem['id'],
                image_url: $imageItem['image_url'],
                post_id: $imageItem['post_id'],
            );
        }, $imageItems);
    }
}
