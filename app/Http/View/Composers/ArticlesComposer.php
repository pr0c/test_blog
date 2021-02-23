<?php

namespace App\Http\View\Composers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\View\View;

class ArticlesComposer
{
    protected $categoryRepository;
    protected $tagRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, TagRepositoryInterface $tagRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function compose(View $view)
    {
        $view->with('categories', $this->categoryRepository->all());
        $view->with('tags', $this->tagRepository->all());
    }
}
