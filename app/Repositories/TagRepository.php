<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function all()
    {
        return Tag::all();
    }
}
