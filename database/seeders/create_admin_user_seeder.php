<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class create_admin_user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'is_admin' => 1
        ]);
    }
}
