<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/',[FrontendController::class,'index'])->name('root');
//dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//management
Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
Route::post('/management/user/role', [ManagementController::class, 'store_register'])->name('management.store');
Route::post('/management/manager/down/{id}', [ManagementController::class, 'manager_down'])->name('management.manager.down');


//profile
Route::get('/home/profile/setings', [ProfileController::class,'index'])->name('profile.setting');
Route::post('/home/profile/name/update', [ProfileController::class,'name_update'])->name('profile.name.update');
Route::post('/home/profile/email/update', [ProfileController::class,'email_update'])->name('profile.email.update');
Route::post('/home/profile/password/update', [ProfileController::class,'password_update'])->name('profile.password.update');
Route::post('/home/profile/image/update', [ProfileController::class,'image_update'])->name('profile.image.update');
//category
Route::get('/Category',[CategoryController::class,'index'])->name('category.index');
Route::post('/Category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('/Category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/Category/update/{slug}',[CategoryController::class,'update'])->name('category.update');
Route::get('/Category/delete/{slug}',[CategoryController::class,'delete'])->name('category.delete');
Route::post('/Category/status/{slug}',[CategoryController::class,'status'])->name('category.status');
