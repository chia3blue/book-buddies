<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;


# Admin Controllers
use App\Http\Controllers\Admin\UsersController;
// use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\CreaturesController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    // Book Post
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
    Route::get('/book/{book_id}/show', [BookController::class, 'show'])->name('book.show');
    Route::get('/book/{book_id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::patch('/book/{book_id}/update', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{book_id}/destroy', [BookController::class, 'destroy'])->name('book.destroy');

    // Profile
    Route::get('/profile/{user_id}/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user_id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    Route::get('/profile/{user_id}/following', [ProfileController::class, 'following'])->name('profile.following');

    // Comment
    Route::post('/comment/{book_id}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{comment_id}/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');

    // Like
    Route::post('/like/{book_id}/store', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/like/{book_id}/destroy', [LikeController::class, 'destroy'])->name('like.destroy');

    // Follow
    Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');

    //Admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
        //User
        Route::get('/users', [UsersController::class, 'index'])->name('users');
        Route::delete('/users/{user_id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');
        Route::patch('/users/{user_id}/activate', [UsersController::class, 'activate'])->name('users.activate');

        //Book
        // Route::get('/books', [BooksController::class, 'index'])->with('books');

        //Creature
        Route::get('/creatures', [CreaturesController::class, 'index'])->name('creatures');
        Route::get('/creatures/create', [CreaturesController::class, 'create'])->name('creatures.create');
        Route::post('/creatures/store', [CreaturesController::class, 'store'])->name('creatures.store');
        // Route::get('/creatures/{creature_id}/edit', [CreaturesController::class, 'edit'])->name('creatures.edit');
        // Route::patch('/creatures/{creature_id}/update', [CreaturesController::class, 'update'])->name('creatures.update');
        Route::delete('/creatures/{creature_id}/destroy', [CreaturesController::class, 'destroy'])->name('creatures.destroy');
    });
});
