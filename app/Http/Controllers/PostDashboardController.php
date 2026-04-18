<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class PostDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{
    $posts = Post::latest();

    if (Auth::user()->role !== 'admin') {
        $posts->where('author_id', Auth::id());
    }

    if (request('keyword')) {
        $posts->where('title', 'like', '%' . request('keyword') . '%');
    }

    return view('dashboard.index', [
        'posts' => $posts->paginate(30)->withQueryString()
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validator = Validator::make(
        $request->all(),
        [
            'title' => 'required|unique:posts|min:8|max:255',
            'category_id' => 'required',
            'body' => 'required',
        ],
        [
            'title.required' => 'Title is required.',
            'title.unique' => 'This title already exists.',
            'title.min' => 'Title must be at least 8 characters.',
            'title.max' => 'Title may not exceed 255 characters.',
            'category_id.required' => 'Please select a category.',
            'body.required' => 'Post body cannot be empty.',
        ]
    );

    // 🔥 VALIDASI KHUSUS QUILL
    $validator->after(function ($validator) use ($request) {
        $plainText = trim(strip_tags($request->body));

        if (strlen($plainText) < 70) {
            $validator->errors()->add(
                'body',
                'Post body must be at least 70 characters.'
            );
        }
    });

    // ❌ JIKA GAGAL
    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
    }

    // SIMPAN
    Post::create([
        'title'       => $request->title,
        'author_id'   => Auth::id(),
        'category_id' => $request->category_id,
        'slug'        => Str::slug($request->title),
        'body'        => $request->body,
    ]);

    return redirect('/dashboard')
        ->with('success', 'New post has been added!');
}





    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        
        return view('dashboard.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
         $this->authorize('update', $post);

        return view('dashboard.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $this->authorize('update', $post);

        //VALIDATION
         $request->validate([
        'title' => ['required', 'min:8', 'max:255',
        Rule::unique('posts', 'title')->ignore($post->id)
         ],
        // 'required|min:8|max:255|unique:posts,title,' . $post->id,
        'category_id' => 'required',
        'body' => 'required'

    ]);


        //UPDATE POST PROCESS
        $post->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title),
            'body' => $request->body
        ]);


        //REDIRECT
        return redirect('/dashboard')->with(['success' => 'Post has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
      $this->authorize('delete', $post);

    
        $post->delete();
        return redirect('/dashboard')->with(['success' => 'Post has been deleted!']);
       
    }
}


