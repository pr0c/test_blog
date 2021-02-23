<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getArticles($keywords = null, $categories = null, $tags = null)
    {
        $articles = Article::with('category', 'tags');
        if(!is_null($keywords))
        {
            $articles = $articles->where('title', 'like', '%' . $keywords . '%');
        }
        if(!is_null($categories) && count($categories) > 0)
        {
            $articles = $articles->whereIn('category_id', $categories);
        }
        if(!is_null($tags) && count($tags) > 0)
        {
            $articles = $articles->whereHas('tags', function($query) use ($tags) {
                $query->whereIn('tags.id', $tags);
            });
        }

        return $articles->get();
    }
}
