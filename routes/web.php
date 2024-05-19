<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::get('/', [UserController::class, 'index'])->name('home');

// sessions work
Route::get('/login', [SessionController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [SessionController::class, 'login'])->middleware('guest');

Route::get('/forgot-password', [SessionController::class, 'reset'])->middleware('guest');
Route::post('/forgot-password', [SessionController::class, 'send'])->middleware('guest');
Route::get('/forgot-password/{token}', [SessionController::class, 'login_without_password'])->middleware('guest')->name('forgot-password');

Route::get('/register', [SessionController::class, 'create'])->middleware('guest');
Route::post('/register', [SessionController::class, 'register'])->middleware('guest');

Route::get('/logout', [SessionController::class, 'destroy'])->middleware('auth');

//site work
Route::get('/cart', [UserController::class, 'cart'])->middleware('auth');
Route::post('/add-to-cart', [ProductController::class, 'newProductToCart'])->middleware('auth');
Route::get('about/{product:id}', [ProductController::class, 'about'])->middleware('auth');
Route::delete('/remove', [ProductController::class, 'destroy'])->middleware('auth');

Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');
Route::get('/profile/orders-history', [UserController::class, 'history'])->middleware('auth');

Route::post('/pay', [ProductController::class, 'pay'])->middleware('auth');
Route::post('/post-comment', [CommentController::class, 'create'])->middleware('auth');
Route::post('/add-point', function(){
    $user = User::find(auth()->user()->id);
    $user->personal_points += 1;
    $user->save();
});
Route::delete('/remove-comment', [CommentController::class, 'destroy'])->middleware('auth');