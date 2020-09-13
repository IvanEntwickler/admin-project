<?php

use App\Post;
use App\User;
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
        // $this->call(UserSeeder::class);
        /// creating 10 Users and one Post foreach User
        factory(User::class, 10)->create()->each(function($user){
            $user->posts()->save(factory(Post::class)->make());
        });
    }
}
