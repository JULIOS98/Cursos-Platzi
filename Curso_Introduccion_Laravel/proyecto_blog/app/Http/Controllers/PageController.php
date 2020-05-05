<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PageController extends Controller
{
    public function posts()
    {
        $posts = Post::load('user')->latest()->paginate();

        return view('posts', [
            'posts' => $posts ,
        ]);
    }

    public function post(Post $post)
    {
        return view('post', [
            'post' => $post,
        ]);
    }
}
