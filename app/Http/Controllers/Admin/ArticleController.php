<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->middleware('auth');
        $this->articleService = $articleService;
    }

    public function index()
    {
        $articles = $this->articleService->getAllArticles();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'tags' => 'nullable|string',
        ]);

        $this->articleService->createArticle($validatedData);

        return redirect()->route('admin.index')->with('success', 'Article created successfully.');
    }

    public function edit($id)
    {
        $article = $this->articleService->getArticle($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'tags' => 'nullable|string',
        ]);

        $article = $this->articleService->getArticle($id);
        $this->articleService->updateArticle($article, $validatedData);

        return redirect()->route('admin.index')->with('success', 'Article updated successfully.');
    }

    public function destroy($id)
    {
        $article = $this->articleService->getArticle($id);
        $this->articleService->deleteArticle($article);

        return redirect()->route('admin.index')->with('success', 'Article deleted successfully.');
    }

    public function upload(Request $request)
    {
        $request->validate(['file' => 'image']);
        $path = $request->file('file')->store('public/uploads');
        return response()->json(['location' => Storage::url($path)]);
    }
}
