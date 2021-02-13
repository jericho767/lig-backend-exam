<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $title = $this->getTitle();

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->realText($this->faker->numberBetween(30, 150)),
        ];
    }

    /**
     * For the sake of the design and implementation of the `slug` property
     * the title of the post will be unique.
     *
     * @return string
     */
    private function getTitle(): string
    {
        do {
            $title = $this->faker->bothify($this->faker->realText($this->faker->numberBetween(10, 20)));
        } while (Post::query()->where('slug', Str::slug($title))->exists() || empty(trim($title)));

        return $title;
    }
}
