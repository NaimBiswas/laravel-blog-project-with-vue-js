<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use phpDocumentor\Reflection\Types\Boolean;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $title = $faker->unique()->sentence();

        foreach (range(1, 25) as $index) {
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
