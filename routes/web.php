<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $article = \App\Models\Article::query()->where('id',1)->with(['comments','ratings'])->first();
//    dd($article->comments);
    $video = \App\Models\Video::query()->where('id',1)->with(['comments', 'ratings'])->first();

    $user = \App\Models\User::query()->where('id',2)->with(['comments', 'ratings'])->first();
//    dd($user);
    $agvRatingArticle = $article->ratings()->avg('rating');
    return view('bai1', compact('article', 'video', 'user', 'agvRatingArticle'));
});
