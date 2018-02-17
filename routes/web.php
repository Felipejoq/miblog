<?php

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

Route::get('/', 'PagesController@home')->name('pages.home');
Route::get('nosotros', 'PagesController@about')->name('pages.about');
Route::get('archivo', 'PagesController@archive')->name('pages.archive');
Route::get('contacto', 'PagesController@contact')->name('pages.contact');

Route::get('blog/{post}', 'PostsController@show')->name('posts.show');
Route::get('category/{category}', 'CategoriesController@show')->name('category.show');
Route::get('tag/{tag}', 'TagsController@show')->name('tag.show');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'],function (){

    Route::resource('posts', 'PostsController',['except' => 'show', 'as' => 'admin']);
    Route::resource('users', 'UsersController',['as' => 'admin']);

    Route::put('users/{user}/roles', 'UserRolesController@update')->name('admin.users.roles.update');
    Route::put('users/{user}/permissions', 'UserPermissionsController@update')->name('admin.users.permissions.update');

    Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.update');
    Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');

    Route::get('/', 'AdminController@index')->name('dashboard');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');