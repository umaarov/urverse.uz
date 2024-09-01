@extends('layouts.app')

@section('content')
    <div>
        <h1>Articles</h1>

        <!-- Search Bar -->
        <form action="{{ route('articles.index') }}" method="GET">
            <input type="text" name="search" placeholder="Search articles..." value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>

        <!-- Tag Filtering -->
        <div>
            @php
                // Extract unique, lowercase tags from articles
                $allTags = $articles
                    ->flatMap(function ($article) {
                        return explode(',', $article->tags);
                    })
                    ->map('trim')
                    ->map('strtolower')
                    ->unique()
                    ->sort()
                    ->values();
            @endphp

            @foreach ($allTags as $tag)
                <a href="{{ route('articles.index', ['tag' => $tag]) }}">#{{ $tag }}</a>
                @if (!$loop->last)
                    |
                @endif
            @endforeach
        </div>

        @forelse ($articles as $article)
            <div>
                <h2>
                    <a href="{{ route('articles.show', $article->id) }}">
                        {{ $article->title }}
                    </a>
                </h2>
                <p><strong>Published:</strong> {{ $article->created_at->format('F j, Y') }}</p>

                <p>
                    <strong>Tags:</strong>
                    @php
                        // Process tags for the current article
                        $tags = explode(',', $article->tags);
                        $tags = array_map('trim', $tags);
                        $tags = array_map('strtolower', $tags);
                        $tags = array_unique($tags);
                    @endphp

                    @foreach ($tags as $tag)
                        <a href="{{ route('articles.index', ['tag' => $tag]) }}">#{{ $tag }}</a>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>

                <p>
                    {{ \Str::limit(strip_tags($article->body), 300) }}
                </p>

                <div>
                    <a href="{{ route('articles.show', $article->id) }}">
                        View Full Article
                    </a>
                </div>

                <hr>
            </div>
        @empty
            <p>No articles available.</p>
        @endforelse
    </div>
@endsection
