<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $title = $faker->sentence(45);

        foreach (range(1, 25) as $index) {
            Post::create([
                "user_id"     => 1,
                "category_id" => rand(1, 9),
                'title' => $title,
                'slug' => Str::slug($title),
                "description" => $faker->paragraph(300),
                "images"   => $faker->imageUrl(),
                "status"      => boolValue(),
            ]);
        }
    }
}
