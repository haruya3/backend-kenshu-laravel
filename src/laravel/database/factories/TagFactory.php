<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        ];
    }

    public function nameIs総合()
    {
        return $this->state(fn () => [
           'name' => '総合',
        ]);
    }

    public function nameIsテクノロジー()
    {
        return $this->state(fn () => [
            'name' => 'テクノロジー',
        ]);
    }
}
