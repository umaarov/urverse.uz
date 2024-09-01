@extends('layouts.app')

@section('content')
    <h1>{{ $article->title }}</h1>
    <p>{!! nl2br(e($article->body)) !!}</p>
    <p><strong>Tags:</strong> {{ $article->tags }}</p>
    <p><em>Published at:</em> {{ $article->created_at->format('M d, Y') }}</p>
    <a href="{{ url('/') }}">Back to Articles</a>
@endsection
