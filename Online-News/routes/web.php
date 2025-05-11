<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Frontend\AuthenticationController;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionRequestController;
use App\Http\Controllers\SocialiteProviderController;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

//Frontend
Route::get('/',[FrontendHomeController::class,'index'])->name('frontend');
Route::get('/category/{slug}',[FrontController::class,'Front_Page'])->name('frontend.Category');
Route::get('/blogs',[FrontendBlogController::class,'index'])->name('frontend.blogs');
Route::get('/blog/single/{slug}',[FrontendBlogController::class,'single'])->name('frontend.blog.single');
Route::post('/blog/comment/{id}',[FrontendBlogController::class,'comment'])->name('frontend.blog.comment');

Route::get('auth/login',[AuthenticationController::class,'login'])->name('auth.login');
Route::post('auth/login',[AuthenticationController::class,'login_post'])->name('auth.login');
Route::get('auth/singup',[AuthenticationController::class,'singup'])->name('auth.singup');
Route::post('auth/singup',[AuthenticationController::class,'singup_post'])->name('auth.singup');


//dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/promotion/role/request', [PromotionRequestController::class, 'index'])->name('promotion.request.show');
    Route::get('/promotion/role/request/accept/{id}', [PromotionRequestController::class, 'accept'])->name('promotion.request.accept');
    Route::get('/promotion/role/request/cancel/{id}', [PromotionRequestController::class, 'cancel'])->name('promotion.request.cancel');
    Route::post('/promotion/role/request/{id}', [PromotionRequestController::class, 'promotion_request'])->name('promotion.request');


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

Route::prefix(env('HOST_NAME'))->middleware(['access'])->group(function(){
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

//blog
Route::resource('blog',BlogController::class);
Route::post('blog/status/{slug}',[BlogController::class,'status'])->name('blog.status');
Route::get('blog/delete/{slug}',[BlogController::class,'destroy'])->name('blog.destroy');
});

//contact
Route::get('contact',[ContactController::class,'index'])->name('contact.index');
Route::post('contact/store',[ContactController::class,'contact_message'])->name('contact.store');

//socialite
Route::get('/auth/{provider}/redirect',[SocialiteProviderController::class,'redirect']);
Route::get('/auth/{provider}/callback',[SocialiteProviderController::class,'callback']);

