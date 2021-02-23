<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
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
        $this->call([
            TagSeeder::class,
            CategorySeeder::class,
            ArticleSeeder::class,
        ]);

        $tags = Tag::all();
        $articles = Article::all();
        $tags = $tags->pluck('id');
        foreach($articles as &$article)
        {
            $article->tags()->sync($tags->slice(rand(1, count($tags)-1))->toArray());
        }
        unset($article);
    }
}
