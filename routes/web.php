<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\HomeController as Home;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\PostController as PostController1;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;

//User Route
Route::get('/',[HomeController::class,'index']);
Route::get('post/{post}',[PostController1::class,'post'])->name('post');

Route::get('post/tag/{tag}',[HomeController::class,'tag'])->name('tag');
Route::get('post/category/{category}',[HomeController::class,'category'])->name('category');

//Admin Routes
Route::get('admin/home',[Home::class,'home'])->name('admin.home');

//User Route
Route::resource('admin/user',UserController::class);

//Role Route
Route::resource('admin/role',RoleController::class);

//Permission Route
Route::resource('admin/permission',PermissionController::class);

//Post Route
Route::resource('admin/post',PostController::class);

//Tag Route
Route::resource('admin/tag',TagController::class);

//Category Route
Route::resource('admin/category',CategoryController::class);

// Admin Login Route
Route::get('admin-login',[AdminLoginController::class,'showLoginForm'])->name('admin.login');
Route::post('admin-login',[AdminLoginController::class,'login']);


/*
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
