<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_url' => 'public/image/user_profile' . fake()->name . '.png',
            'post_id' => Post::factory(),
        ];
    }

    public function specifyPost_id(int $post_id)
    {
        return $this->state(fn () => [
           'post_id' => $post_id,
        ]);
    }
}
