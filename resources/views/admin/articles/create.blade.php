@extends('layouts.app')

@section('content')
    <h1>Create New Article</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        @include('admin.articles.form')
        <button type="submit">Create Article</button>
    </form>

    <a href="{{ route('admin.index') }}">Back to Admin Panel</a>
@endsection
