@extends('layouts.app')

@section('content')
    <div class="articles-page container">
        <header class="page-header">
            <!-- Updated title with special styling classes -->
            <h1 class="site-title">
                <span class="special-letter">U</span>mar<span class="special-letter">o</span>v's Uni<span
                    class="special-verse">verse</span>
            </h1>
            <form action="{{ route('articles.index') }}" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search articles..." value="{{ request('search') }}"
                    aria-label="Search articles">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
            <!-- Tags banner with enhanced design and "Show More/Less" functionality -->
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
                <div class="tags-list">
                    @foreach ($allTags as $tag)
                        <a href="{{ route('articles.index', ['tag' => $tag]) }}" class="tag">#{{ $tag }}</a>
                    @endforeach
                </div>
                <button id="toggle-tags" class="toggle-button">Show More</button>
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

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tagsList = document.querySelector('.tags-list');
                const tags = document.querySelectorAll('.tags-list .tag');
                const toggleButton = document.getElementById('toggle-tags');
                const maxVisibleTags = 10;

                if (tags.length > maxVisibleTags) {
                    for (let i = maxVisibleTags; i < tags.length; i++) {
                        tags[i].classList.add('hidden-tag');
                    }

                    toggleButton.style.display = 'inline-block';
                    toggleButton.addEventListener('click', function() {
                        tagsList.classList.toggle('expanded');

                        if (tagsList.classList.contains('expanded')) {
                            toggleButton.textContent = 'Show Less';
                            tags.forEach(tag => tag.classList.remove('hidden-tag'));
                        } else {
                            toggleButton.textContent = 'Show More';
                            for (let i = maxVisibleTags; i < tags.length; i++) {
                                tags[i].classList.add('hidden-tag');
                            }
                        }
                    });
                }
            });
        </script>
    @endsection
@endsection
