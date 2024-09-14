@extends('layouts.app')

@section('content')
    <div class="articles-page container">
        <header class="page-header">
            <h1>U<span class="special-letter">R</span>marov's Uni<span class="special-letter">verse</span></h1>
            <form action="{{ route('articles.index') }}" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search articles..." value="{{ request('search') }}"
                    aria-label="Search articles">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
            <div class="tags-banner">
                @php
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
                    <a href="{{ route('articles.index', ['tag' => $tag]) }}" class="tag">#{{ $tag }}</a>
                @endforeach
            </div>
        </header>

        <div class="content-wrapper">
            <main class="articles-list">
                @forelse ($articles as $article)
                    <article class="card">
                        <div class="card-content">
                            <h2 class="card-title">
                                <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                            </h2>
                            <p class="card-excerpt">{{ \Str::limit(strip_tags($article->body), 150) }}</p>
                            <div class="card-meta">
                                <span class="published-date">Published: {{ $article->created_at->format('F j, Y') }}</span>
                                <div class="card-tags">
                                    @php
                                        $tags = explode(',', $article->tags);
                                        $tags = array_map('trim', $tags);
                                        $tags = array_map('strtolower', $tags);
                                        $tags = array_unique($tags);
                                    @endphp

                                    @foreach ($tags as $tag)
                                        <a href="{{ route('articles.index', ['tag' => $tag]) }}"
                                            class="tag">#{{ $tag }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="no-articles">No articles available.</p>
                @endforelse

                <div class="pagination-wrapper">
                    {{ $articles->withQueryString()->links() }}
                </div>
            </main>
        </div>
    </div>
@endsection
