<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(Post::class);

        for ($i = 1; $i <= 20; $i++) {
            $title = $faker->unique()->sentence();
            Post::create([
                "user_id"     => 1,
                "category_id" => rand(1, 9),
                'title' => $title,
                'slug' => Str::slug($title),
                "description" => $faker->paragraph(),
                "images"   => $faker->imageUrl(),
                "status"      => true,
            ]);
        }
    }
}
