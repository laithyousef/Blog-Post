<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;


class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Post::class;
    public function definition()
    {
        $name = $this->faker->text(20);
        return [
            'title' => $name,
            'body'=> $this->faker->text(200),
            'slug' => Str::slug($name),
            'category_id' => rand(1,10),
            'image' => $name
        ];
    }
}
