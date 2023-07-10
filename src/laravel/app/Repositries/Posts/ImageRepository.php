<?php
declare(strict_types=1);

namespace App\Repositries\Posts;

use App\Models\Image;
use Illuminate\Support\Facades\DB;

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

    /**
     * @param \App\Entity\Image[] $images
     * @return bool
     */
    public function createByPost(array $images): bool
    {
        DB::table('images')->insert(
            array_map(fn ($image) => [
                'image_url' => $image->image_url,
                'post_id' => $image->post_id,
            ], $images)
        );
        return true;
    }
}
