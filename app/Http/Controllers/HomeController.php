<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::with('user', 'likes', 'comments')->get();

        return view('users.pages.home', [
            'posts' => $posts
        ]);
    }
}
