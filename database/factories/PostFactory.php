<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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

    // $factory->define(Post::class, function (Faker $faker) {
    //     return [
    //         'user_id' => factory('App\Models\User'),
    //         'title' => $this->faker->sentence,
    //         'post_image' => $this->faker->imageUrl('900', '300'),
    //         'body' => $this->faker->paragraph
    //     ]
    // });


    public function definition()
    {
        return [
            //
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->sentence(7, 11),
            'post_image' => $this->faker->imageUrl('900', '300'),
            'body' => $this->faker->paragraphs(rand(2, 6), true),
        ];
    }


}
