<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            
            $user = User::inRandomOrder()->first();

            $newPost = new Post;
            $newPost->title = $faker->text(50);
            $newPost->user_id = $user->id;
            $newPost->cover = $faker->imageUrl(200, 300);
            $newPost->content = $faker->paragraph(7, true);
            $newPost->slug = $faker->slug;
            $newPost->save();
        }
    }
}
