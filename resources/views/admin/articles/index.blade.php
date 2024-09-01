@extends('layouts.app')

@section('content')
    <h1>Admin Panel - Articles</h1>

    <!-- Link to Create New Article -->
    <div>
        <a href="{{ route('articles.create') }}">Create New Article</a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div>
            <strong>Success:</strong> {{ session('success') }}
        </div>
    @endif

    <!-- Articles List -->
    @if ($articles->count())
        @foreach ($articles as $article)
            <div>
                <h2>{{ $article->title }}</h2>

                <p><strong>Excerpt:</strong> {{ Str::limit(strip_tags($article->body), 150) }}</p>

                <p><strong>Tags:</strong>
                    @foreach (explode(',', $article->tags) as $tag)
                        #{{ trim($tag) }}
                        @if (!$loop->last)
                            |
                        @endif
                    @endforeach
                </p>

                <p><strong>Published At:</strong> {{ $article->created_at->format('M d, Y') }}</p>

                <div>
                    <a href="{{ route('articles.edit', $article->id) }}">Edit</a>

                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p>No articles found.</p>
    @endif
@endsection
