<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    public function all()
    {
        return Article::all();
    }

    public function find($id)
    {
        return Article::findOrFail($id);
    }

    public function search($searchTerm, $tag = null)
    {
        $query = Article::query();

        if ($searchTerm) {
            $query->where('title', 'like', "%{$searchTerm}%")
                ->orWhere('body', 'like', "%{$searchTerm}%");
        }

        if ($tag) {
            $query->where('tags', 'like', "%{$tag}%");
        }

        return $query->get();
    }

    public function create(array $data)
    {
        return Article::create($data);
    }

    public function update(Article $article, array $data)
    {
        return $article->update($data);
    }

    public function delete(Article $article)
    {
        return $article->delete();
    }
}
