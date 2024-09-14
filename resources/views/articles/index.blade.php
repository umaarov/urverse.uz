@extends('layouts.app')

@section('content')
    <div class="articles-page container">
        <header class="page-header">
            <h1>Tech Articles</h1>
            <form action="{{ route('articles.index') }}" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search articles..." value="{{ request('search') }}"
                    aria-label="Search articles">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </header>

        <div class="content-wrapper">
            <aside class="sidebar">
                <h2>Tags</h2>
                <div class="tags">
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
            </aside>

            <main class="articles-list">
                @forelse ($articles as $article)
                    <article class="card">
                        <div class="card-content">
                            <h2 class="card-title">
                                <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                            </h2>
                            <p class="card-excerpt">
                                {{ \Str::limit(strip_tags($article->body), 150) }}
                            </p>
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
                        <div class="card-image">
                            <img src="{{ $article->image_url ?? 'https://via.placeholder.com/400x200' }}"
                                alt="{{ $article->title }}">
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
