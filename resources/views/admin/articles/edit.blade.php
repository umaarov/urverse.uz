@extends('layouts.app')

@section('content')
    <h1>Edit Article</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.articles.form')
        <button type="submit">Update Article</button>
    </form>

    <a href="{{ route('admin.index') }}">Back to Admin Panel</a>
@endsection
