<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display all posts (admin view)
     */
   public function index(Request $request)
{
    $posts = Post::with(['author', 'category'])
        ->latest()

        // SEARCH: title OR author name
        ->when($request->keyword, function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhereHas('author', function ($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->keyword . '%');
                  });
        })

        // FILTER: category
        ->when($request->category, function ($query) use ($request) {
            $query->where('category_id', $request->category);
        })

        ->paginate(20)
        ->withQueryString();

    return view('admin.posts.index', [
        'posts'      => $posts,
        'categories' => Category::all(),
    ]);
}


    /**
     * Show edit form (admin can edit any post)
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update post (admin override)
     */
    public function update(Request $request, Post $post)
{
    $request->validate([
        'title' => ['required','min:8','max:255', Rule::unique('posts')->ignore($post->id)],
        'category_id' => 'required',
        // remove body validation
    ]);

    $post->update([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'category_id' => $request->category_id,
        // keep the body untouched
    ]);

    return redirect()
        ->route('admin.posts.index')
        ->with('success', 'Post updated successfully.');
}


    /**
     * Delete post (admin force delete)
     */
   public function destroy(Post $post)
{
    $post->delete();

    return redirect()
    ->back()
    ->with('success', 'Post deleted successfully.');

}



}
