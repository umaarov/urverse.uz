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

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/sx36c27rc7thjis4dfkf1mricf1fl7zoff4rqkm4v725q29x/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#body',
            plugins: 'code image lists link',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code | image | link',
            height: 500,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    </script>
@endsection
