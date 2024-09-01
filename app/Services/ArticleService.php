<?php

namespace App\Services;

use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;

class ArticleService
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getAllArticles()
    {
        return $this->articleRepository->all();
    }

    public function getArticle($id)
    {
        return $this->articleRepository->find($id);
    }

    public function searchArticles(Request $request)
    {
        return $this->articleRepository->search(
            $request->input('search'),
            $request->input('tag')
        );
    }

    public function createArticle(array $data)
    {
        return $this->articleRepository->create($data);
    }

    public function updateArticle($article, array $data)
    {
        return $this->articleRepository->update($article, $data);
    }

    public function deleteArticle($article)
    {
        return $this->articleRepository->delete($article);
    }
}
