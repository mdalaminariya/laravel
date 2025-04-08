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

Route::prefix(env('HOST_NAME'))->middleware(['rolecheck'])->group(function(){
    //management
    Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
    Route::post('/management/user/role', [ManagementController::class, 'store_register'])->name('management.store');
    Route::post('/management/manager/down/{id}', [ManagementController::class, 'manager_down'])->name('management.manager.down');

    //role
    Route::get('/management/role', [ManagementController::class, 'role_index'])->name('management.role.index');
    Route::post('/management/role/assign', [ManagementController::class, 'role_assign'])->name('management.role.assign');
    Route::post('/management/role/blogger/{id}', [ManagementController::class, 'blogger_gread_down'])->name('management.role.blogger.demotion');
    Route::post('/management/role/user/{id}', [ManagementController::class, 'user_gread_down'])->name('management.role.user.demotion');
    Route::get('/management/role/user/block', [ManagementController::class, 'block_user'])->name('management.user.block');
    Route::post('/management/role/user/Unblock/{id}', [ManagementController::class, 'unblock_user'])->name('management.user.unblock');
    Route::post('/management/role/user/autodelete/{id}', [ManagementController::class, 'auto_delete'])->name('management.user.unblock');

});



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
