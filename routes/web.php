<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

/*
|--------------------------------------------------------------------------
| Public Blog Routes
|--------------------------------------------------------------------------
*/

Route::get('/posts', function () {
    $posts = Post::latest()
        ->filter(request(['search', 'category', 'author']))
        ->paginate(5)
        ->withQueryString();

    $title = 'Blog';

    if (request('category')) {
        $category = Category::where('slug', request('category'))->first();
        if ($category) {
            $title = 'Category: ' . $category->name;
        }
    }

    return view('posts', compact('posts', 'title'));
})->name('posts');

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post-article', [
        'title' => $post->title,
        'singlepost' => $post,
    ]);
})->name('post.detail');

/*
|--------------------------------------------------------------------------
| Static Pages
|--------------------------------------------------------------------------
*/

Route::view('/home', 'home', ['title' => 'Home'])->name('home');
Route::view('/about', 'about', ['title' => 'About Us'])->name('about');
Route::view('/contact', 'contact', ['title' => 'Contact'])->name('contact');

/*
|--------------------------------------------------------------------------
| User Dashboard (Authenticated + Verified Users)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [PostDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/create', [PostDashboardController::class, 'create'])
        ->name('dashboard.post.create');

    Route::post('/dashboard', [PostDashboardController::class, 'store'])
        ->name('dashboard.post.store');

    Route::get('/dashboard/{post:slug}', [PostDashboardController::class, 'show'])
        ->name('dashboard.post.show');

    Route::get('/dashboard/{post:slug}/edit', [PostDashboardController::class, 'edit'])
        ->name('dashboard.post.edit');

    Route::patch('/dashboard/{post:slug}', [PostDashboardController::class, 'update'])
        ->name('dashboard.post.update');

    Route::delete('/dashboard/{post:slug}', [PostDashboardController::class, 'destroy'])
        ->name('dashboard.post.delete');
});

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Admins Only)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Posts
        Route::get('/posts', [AdminPostController::class, 'index'])
            ->name('posts.index');

        Route::get('/posts/{post:slug}/edit', [AdminPostController::class, 'edit'])
            ->name('posts.edit');

        Route::patch('/posts/{post:slug}', [AdminPostController::class, 'update'])
            ->name('posts.update');

        Route::delete('/posts/{post:slug}', [AdminPostController::class, 'destroy'])
            ->name('posts.destroy');

        // ✅ Email Author (remove extra /admin)
        Route::get('/posts/{post}/email-author', [AdminPostController::class, 'emailAuthor'])
            ->name('posts.emailAuthor');

    });


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
