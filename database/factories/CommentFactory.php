<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Comment;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(20),
            'email'=> $this->faker->unique()->safeEmail(),
            'comment' => $this->faker->text(200),
            'approved' => rand(1,10),
            'post_id' => rand(1,10)
        ];
    }
}
