<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'tags'];

    public function scopeSearch($query, $searchTerm, $tag = null)
    {
        if ($searchTerm) {
            $query->where('title', 'like', "%{$searchTerm}%")
                ->orWhere('body', 'like', "%{$searchTerm}%");
        }

        if ($tag) {
            $query->where('tags', 'like', "%{$tag}%");
        }

        return $query;
    }
}
