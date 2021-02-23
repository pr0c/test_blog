<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getArticles(Request $request)
    {
        $keywords = $request->get('keywords');
        $categories = $request->get('categories');
        $tags = $request->get('tags');

        $articles = $this->articleRepository->getArticles($keywords, $categories, $tags);

        if(is_null($categories)) $categories = [];
        if(is_null($tags)) $tags = [];
        if(is_null($keywords)) $keywords = '';

        return view('article/index', [
            'articles' => $articles,
            'selectedCategories' => $categories,
            'selectedTags' => $tags,
            'selectedKeywords' => $keywords
        ]);
    }
}
