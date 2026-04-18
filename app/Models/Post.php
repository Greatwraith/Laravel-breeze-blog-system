<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'author_id',
        'category_id',
        'body'
    ];

    protected $with = ['author', 'category'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    

    

  public function scopeFilter(Builder $query, array $filters): Builder
{
    // SEARCH
    $query->when($filters['search'] ?? false, function ($query, $search) {
        $query->where('title', 'like', '%' . $search . '%');
    });

    // CATEGORY
    $query->when($filters['category'] ?? false, function ($query, $category) {
        $categoryId = \App\Models\Category::where('slug', $category)->value('id');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
    });

    $query->when($filters['author'] ?? false, function ($query, $author) {
        $authorId = \App\Models\User::where('username', $author)->value('id');

        if ($authorId) {
            $query->where('author_id', $authorId);
        }
    });
    

    return $query;
}


}
