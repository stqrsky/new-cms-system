<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // DB::table('users')->truncate();
        // DB::table('posts')->truncate();

                
         //User::factory(10)->create();
         //Post::factory(10)->create();

        User::factory(3)->create()->each(function($user){       // chain a each-function, with having a callback to have that user
            $user->posts()->save(Post::factory()->make());      //use created instance $user to access the relationship ->posts(), 
                                                                //, entering related Model called Post, works cause of users_id in post table
        });

        // User::factory(10)->create();
        // Post::factory(10)->create();
    }

}
