<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Post;

Route::get('/prueba', function(){
    //$post = Post::all(); --Obtener todos los post
    $post = Post::where('id', '>=', '20')
                ->orderBy('id','desc')
                ->take(5)
                ->get();

    return $post;
});



Route::get('/posts', function(){
    //$post = Post::all(); --Obtener todos los post
    $posts = Post::all();

    foreach($posts as $post){
        $post->id;
        $post->user->name;
        $post->title;
    }

    return $post;
});





Route::get('/', function () {
    return view('welcome');
});
