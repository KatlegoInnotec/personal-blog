<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
     //$posts = Post::where('user_id', auth()->id())->get();

     if(auth()->check()) {
          $posts = auth()->user()->UserPosts()->latest()->get();
     }else {
         $posts =[];
     }
    return view('home', ['posts' => $posts]);
}); 

Route::post('/register',[UserController::class,'register']);

Route::post('/logout', [UserController::class,'logout']);

Route::post('/login', [UserController::class,'login']);

//Blog post related rounte 
Route::post('/create-post',[BlogController::class, 'createPost']);
Route::get('/edit-post/{post}',[BlogController::class, 'showEditBolg']);
Route::put('/edit-post/{post}',[BlogController::class, 'editBolg']);
Route::delete('/delete-post/{post}',[BlogController::class, 'deletetBolg']);


