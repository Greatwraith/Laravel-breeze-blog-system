<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'postCount'     => Post::count(),
            'userCount'     => User::count(),
            'categoryCount' => Category::count(),
            'latestPosts'   => Post::latest()->take(5)->get(),
        ]);
    }
}
