<div>
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="{{ old('title', $article->title ?? '') }}" required>
</div>

<div>
    <label for="body">Body:</label>
    <textarea name="body" id="body" rows="10" required>{{ old('body', $article->body ?? '') }}</textarea>
</div>

<div>
    <label for="tags">Tags (comma-separated):</label>
    <input type="text" name="tags" id="tags" value="{{ old('tags', $article->tags ?? '') }}">
</div>
