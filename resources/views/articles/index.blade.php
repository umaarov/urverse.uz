@extends('layouts.app')

@section('content')
    <h1>Articles</h1>
    @foreach ($articles as $article)
        <div>
            <h2><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></h2>
            <p>{{ \Str::limit(strip_tags($article->body), 150) }}</p>
            <a href="{{ route('articles.show', $article->id) }}">Read More</a>
        </div>
    @endforeach
@endsection
