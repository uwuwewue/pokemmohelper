<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserShinyController;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/user/{username}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
Route::get('/search/live', [SearchController::class, 'liveSearch'])->name('search.live');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/pokedex', [PokemonController::class, 'index'])->name('pokedex');
    Route::post('/pokedex/{pokemon}/toggle', [PokemonController::class, 'toggleCatch'])->name('pokedex.toggle');
    Route::get('/shiny/create', [UserShinyController::class, 'create'])->name('shiny.create');
    Route::post('/shiny/store', [UserShinyController::class, 'store'])->name('shiny.store');
    Route::get('/shiny/{id}/edit', [UserShinyController::class, 'edit'])->name('shiny.edit');
    Route::put('/shiny/{id}', [UserShinyController::class, 'update'])->name('shiny.update');
    Route::delete('/shiny/{id}', [UserShinyController::class, 'destroy'])->name('shiny.destroy');
    Route::post('/community', [CommunityController::class, 'store'])->name('community.store');
    Route::put('/community/{post}', [CommunityController::class, 'update'])->name('community.update');
    Route::delete('/community/{post}', [CommunityController::class, 'destroy'])->name('community.destroy');
    Route::post('/post/{id}/like', [LikeController::class, 'toggle'])->name('post.like');
    Route::post('/post/{id}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/user/{user}/follow', [FollowController::class, 'toggle'])->name('user.follow');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
