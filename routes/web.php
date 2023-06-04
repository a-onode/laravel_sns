<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FavoritesController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/search', [UsersController::class, 'search'])
    ->middleware(['auth'])
    ->name('users.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('users', UsersController::class)
    ->middleware(['auth']);

Route::resource('tweets', TweetsController::class)
    ->middleware(['auth']);

Route::resource('followers', FollowersController::class)
    ->middleware(['auth']);

Route::resource('comments', CommentsController::class)
    ->middleware(['auth']);

Route::resource('favorites', FavoritesController::class)
    ->middleware(['auth']);

require __DIR__ . '/auth.php';
