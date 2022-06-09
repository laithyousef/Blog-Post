<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('auth/register' , 'App\Http\Controllers\AuthController@getRegister')->middleware('guest');
Route::post('auth/register' , 'App\Http\Controllers\AuthController@postRegister')->name('auth.register')->middleware('guest');


Route::get('auth/login' , 'App\Http\Controllers\AuthController@getLogin')->middleware('guest');
Route::post('auth/login' , 'App\Http\Controllers\AuthController@postLogin')->name('auth.login')->middleware('guest');

// Google Login
Route::get('login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [AuthController::class, 'handleGoogleCallback']);
// Facebook Login
Route::get('login/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [AuthController::class, 'handleFacebookCallback']);
// Github Login
Route::get('login/github', [AuthController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [AuthController::class, 'handleGithubCallback']);


Route::get('auth/logout' , 'App\Http\Controllers\AuthController@getLogout')->name('auth.logout')->middleware('auth');


Route::get('auth/password/reset/{token?}' , 'App\Http\Controllers\PasswordController@showResetForm');
Route::post('auth/password/email' , 'App\Http\Controllers\PasswordController@sendResetLinkEmail')->name('password.email');
Route::get('auth/password/email' , 'App\Http\Controllers\PasswordController@getSendResetLinkEmail');
Route::post('auth/password/reset' , 'App\Http\Controllers\PasswordController@resetPassword')->name('password.reset');


Route::get('blog/{slug}' ,['as' => 'blog.single' , 'uses' => 'App\Http\Controllers\BlogController@getSingle'])
 ->where('slug' , '[\w\d\-\_]+');
Route::get('/', 'App\Http\Controllers\PagesController@getIndex')->name('pages.welcome');
Route::get('contact' , 'App\Http\Controllers\PagesController@getContact')->name('pages.contact');
Route::post('contact' , 'App\Http\Controllers\PagesController@postContact');
Route::resource('posts' , 'App\Http\Controllers\PostController')->middleware('auth');


Route::resource('categories' , 'App\Http\Controllers\CategoryController' , ['except' => ['create']]);
Route::resource('tags' , 'App\Http\Controllers\TagController' , ['except' => ['create']]);
Route::resource('comments' , 'App\Http\Controllers\CommentsController' , ['except' => ['create']]);
Route::post('comments/{post_id}' , 'App\Http\Controllers\CommentsController@store')->name('comments.store');
Route::get('comments/{id}/edit' , 'App\Http\Controllers\CommentsController@edit')->name('comments.edit');
Route::put('comments/{id}' , 'App\Http\Controllers\CommentsController@update')->name('comments.update');
Route::delete('comments/{id}' , 'App\Http\Controllers\CommentsController@destroy')->name('comments.destroy');
Route::get('comments/{id}/delete' , 'App\Http\Controllers\CommentsController@delete')->name('comments.delete');

