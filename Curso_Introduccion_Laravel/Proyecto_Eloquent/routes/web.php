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
use App\User;

Route::get('/prueba', function(){
    //$post = Post::all(); --Obtener todos los post
    $post = Post::where('id', '>=', '20')
                ->orderBy('id','desc')
                ->take(5)
                ->get();

    return $post;
});


//Arreglo en Json
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

//Regreso con datos con echo
Route::get('/post', function(){
    //$post = Post::all(); --Obtener todos los post
    $posts = Post::all();

    foreach($posts as $post){
        
         echo" {$post->id} <strong> {$post->user->get_name} </strong>  {$post->title}</br>";
           
    }

   
});


//Arreglo en Json
Route::get('/users', function(){
    //$post = Post::all(); --Obtener todos los post
    $users = User::all();

    foreach($users as $user){
        $user->id;
        $user->get_name;
        $user->posts;
    }

    return $user;
});

Route::get('/collections', function(){
    //$post = Post::all(); --Obtener todos los post
    $users = User::all();

    //dd($users->contains(5)); //Verifica si existe en la bd
    //dd($users->except([1,2,3]));
    //dd($users->only(4));
    //dd($users->find(2));
    dd($users->load('posts'));

   
});

Route::get('/serialization', function(){
    //$post = Post::all(); --Obtener todos los post
    $users = User::all();

    //dd($users->toArray()); //Imprime un array

    $user = $users = User::find(1);
    dd($user->toJson());

   
});









Route::get('/', function () {
    return view('welcome');
});
