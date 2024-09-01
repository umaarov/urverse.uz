@extends('layouts.app')

@section('content')
    <h1>Admin Panel - Articles</h1>
    <a href="{{ route('articles.create') }}">Create New Article</a>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @foreach ($articles as $article)
        <div>
            <h2>{{ $article->title }}</h2>
            <p>{{ Str::limit(strip_tags($article->body), 150) }}</p>
            <p><strong>Tags:</strong> {{ $article->tags }}</p>
            <p><em>Published at:</em> {{ $article->created_at->format('M d, Y') }}</p>

            <a href="{{ route('articles.edit', $article->id) }}">Edit</a>
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @endforeach
@endsection
