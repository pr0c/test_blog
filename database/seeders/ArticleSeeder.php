<?php

namespace Database\Seeders;

use App\Models\Article;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()->count(20)->create();
    }
}
