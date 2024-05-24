<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(UserSeeder::class);
        $users = User::all();
        
        // 10 kategori ve her kategori için 2 post
        Category::factory(10)->create()->each(function ($category) use ($users) {
            Post::factory(2)->create([
                'category_id' => $category->id,
                'user_id' => $users->random()->id,
            ]);
        });
    }
}
