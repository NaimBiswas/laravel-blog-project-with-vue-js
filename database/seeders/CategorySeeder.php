<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'PHP',
            'slug' => 'php',
            'status' => true,
        ]);
        Category::create([
            'name' => 'HTML',
            'slug' => 'html',
            'status' => true,
        ]);
        Category::create([
            'name' => 'CSS',
            'slug' => 'css',
            'status' => true,
        ]);
        Category::create([
            'name' => 'LARAVEL',
            'slug' => 'laravel',
            'status' => true,
        ]);
        Category::create([
            'name' => 'WORDPRESS',
            'slug' => 'wordpress',
            'status' => true,
        ]);
        Category::create([
            'name' => 'VUE-JS',
            'slug' => 'vue-js',
            'status' => true,
        ]);
        Category::create([
            'name' => 'JAVASCRIPT',
            'slug' => 'javascript',
            'status' => true,
        ]);
        Category::create([
            'name' => 'API',
            'slug' => 'api',
            'status' => true,
        ]);
        Category::create([
            'name' => 'RESETFULL-API',
            'slug' => 'resetfull-api',
            'status' => true,
        ]);
    }
}
