<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([create_admin_user_seeder::class]);
         \App\Models\User::factory(10)->create();
         \App\Models\Post::factory(10)->create();
         \App\Models\Category::factory(10)->create();
         \App\Models\Tag::factory(20)->create();
         \App\Models\Comment::factory(10)->create();
    }
}
