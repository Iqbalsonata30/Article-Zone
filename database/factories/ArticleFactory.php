<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence('3', true);
        return [
            'title'         => $title,
            'users_id'       => User::factory(''),
            'slug'          => Str::slug($title, '-'),
            'description'   => fake()->sentences(3, true),
            'tag'           => fake()->word()
        ];
    }
}
