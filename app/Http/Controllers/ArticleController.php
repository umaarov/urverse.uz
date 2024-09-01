<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $articles = $this->articleService->searchArticles($request);
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = $this->articleService->getArticle($id);
        return view('articles.show', compact('article'));
    }
}
