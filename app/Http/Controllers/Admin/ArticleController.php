<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'tags' => 'nullable|string',
        ]);

        Article::create($request->all());

        return redirect()->route('admin.index')->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'tags' => 'nullable|string',
        ]);

        $article->update($request->all());

        return redirect()->route('admin.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.index')->with('success', 'Article deleted successfully.');
    }

    public function upload(Request $request)
    {
        $request->validate(['file' => 'image']);

        $path = $request->file('file')->store('public/uploads');

        return response()->json(['location' => Storage::url($path)]);
    }
}
