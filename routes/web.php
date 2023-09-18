<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PaypalController;

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


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::get('payment-paypal', [PaypalController::class,'postPaymentWithpaypal'])->name('payment-paypal')->middleware('auth');
Route::get('status', [PaypalController::class,'getPaymentStatus'])->name('status')->middleware('auth');

Route::get('/product-grids',[FrontendController::class,'productGrids'])->name('product-grids');

Auth::routes(['register'=>false]);

Route::get('user/login',[FrontendController::class,'login'])->name('login.form');
Route::post('user/login',[FrontendController::class,'loginSubmit'])->name('login.submit');
Route::get('user/logout',[FrontendController::class,'logout'])->name('user.logout');


Route::get('user/register',[FrontendController::class,'register'])->name('register.form');
Route::post('user/register',[FrontendController::class,'registerSubmit'])->name('register.submit');

Route::get('admin/login',[LoginController::class,'admin_login'])->name('admin_login.form');

Route::get('vendor/login',[LoginController::class,'vendor_login'])->name('vendor_login.form');
Route::post('vendor/login',[LoginController::class,'vendor_login_submit'])->name('vendor.login');
Route::post('vendor/register',[FrontendController::class,'vendorregisterSubmit'])->name('vendor_register.submit');
// Reset password
Route::post('password-reset', [FrontendController::class,'showResetForm'])->name('password.reset'); 
// Socialite 
Route::get('login/{provider}/', [\App\Http\Controllers\Auth\LoginController::class,'redirect'])->name('login.redirect');
Route::get('login/{provider}/callback/', [\App\Http\Controllers\Auth\LoginController::class,'Callback'])->name('login.callback');

Route::get('/',[FrontendController::class,'home'])->name('home');

// Frontend Routes
Route::get('/home', [FrontendController::class,'index']);
Route::get('/terms', [FrontendController::class,'terms'])->name('terms');
Route::get('/privacy-policy', [FrontendController::class,'privacy_policy'])->name('privacy-policy');
Route::get('/about-us',[FrontendController::class,'aboutUs'])->name('about-us');
Route::get('/how-to-use',[FrontendController::class,'howtouse'])->name('how-to-use');
Route::get('/commerce-policy',[FrontendController::class,'commerce_policy'])->name('commerce-policy');
Route::get('/dispute-policy',[FrontendController::class,'dispute_policy'])->name('dispute-policy');
Route::get('/fee-schedule',[FrontendController::class,'fee_schedule'])->name('fee-schedule');
Route::get('/postage-label-terms',[FrontendController::class,'postage_label_terms'])->name('postage-label-terms');
Route::get('/FAQ',[FrontendController::class,'faqs'])->name('FAQ');
Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
Route::post('/productqa/store',[FrontendController::class,'product_qa_store'])->name('productqa.store');
Route::post('/contact/message',[\App\Http\Controllers\MessageController::class,'store'])->name('contact.store');
Route::get('product-detail/{slug}',[FrontendController::class,'productDetail'])->name('product-detail');
Route::get('/product-review-fetch/{slug}/{id}',[FrontendController::class,'product_review_fetch'])->name('product-review-fetch');
Route::post('/product/search',[FrontendController::class,'productSearch'])->name('product.search');
Route::get('/product-cat/{slug}',[FrontendController::class,'productCat'])->name('product-cat');
Route::get('/product-sub-cat/{slug}',[FrontendController::class,'productSubCat'])->name('product-sub-cat');
Route::get('/product-brand/{slug}',[FrontendController::class,'productBrand'])->name('product-brand');
// Cart section
Route::get('/add-to-cart/{slug}',[\App\Http\Controllers\CartController::class,'addToCart'])->name('add-to-cart')->middleware('user');
Route::post('/add-to-cart',[\App\Http\Controllers\CartController::class,'singleAddToCart'])->name('single-add-to-cart')->middleware('user');
Route::get('cart-delete/{id}',[\App\Http\Controllers\CartController::class,'cartDelete'])->name('cart-delete');
Route::post('cart-update',[\App\Http\Controllers\CartController::class,'cartUpdate'])->name('cart.update');


// Blog
Route::get('/blog',[FrontendController::class,'blog'])->name('blog');
Route::get('/blog-detail/{slug}',[FrontendController::class,'blogDetail'])->name('blog.detail');
Route::get('/blog/search',[FrontendController::class,'blogSearch'])->name('blog.search');
Route::post('/blog/filter',[FrontendController::class,'blogFilter'])->name('blog.filter');
Route::get('blog-cat/{slug}',[FrontendController::class,'blogByCategory'])->name('blog.category');
Route::get('blog-tag/{slug}',[FrontendController::class,'blogByTag'])->name('blog.tag');

// NewsLetter
Route::post('/subscribe',[FrontendController::class,'subscribe'])->name('subscribe');


// Backend section start

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
    Route::get('/dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('admin.dashboard');
    
    Route::get('/file-manager',function(){
        return view('backend.layouts.file-manager');
    })->name('file-manager');
    Route::resource('college',\App\Http\Controllers\Admin\CollegesController::class);
    Route::resource('sport',\App\Http\Controllers\Admin\SportsController::class);
    // user route
    Route::resource('users',\App\Http\Controllers\UsersController::class);
    // vendor route
    Route::resource('vendors',\App\Http\Controllers\VendorsController::class);
    // Settings
    Route::get('settings',[\App\Http\Controllers\Admin\AdminController::class,'settings'])->name('settings');
    Route::post('setting/update',[\App\Http\Controllers\Admin\AdminController::class,'settingsUpdate'])->name('settings.update');

    // Profile
    Route::get('/profile',[\App\Http\Controllers\Admin\AdminController::class,'profile'])->name('admin.profile');
    Route::post('/profile/{id}',[\App\Http\Controllers\Admin\AdminController::class,'profileUpdate'])->name('profile-update');
    
    // Password Change
    Route::get('change-password', [\App\Http\Controllers\Admin\AdminController::class,'changePassword'])->name('change.password.form');
    Route::post('change-password', [\App\Http\Controllers\Admin\AdminController::class,'changPasswordStore'])->name('change.password');
});






// Vendor
Route::group(['prefix'=>'/vendor','middleware'=>['auth','vendor']],function(){
    Route::get('/dashboard',[\App\Http\Controllers\Vendor\DashboardController::class,'index'])->name('vendor.dashboard');
    // Product
    Route::resource('/vproduct',\App\Http\Controllers\Vendor\ProductController::class);
    Route::get('/vproductqa',[\App\Http\Controllers\Vendor\ProductQAController::class,'index'])->name('vproductqa.index');
    Route::get('/vproductqa/edit/{id}',[\App\Http\Controllers\Vendor\ProductQAController::class,'edit'])->name('vproductqa.edit');
    Route::put('/vproductqa/update/{id}',[\App\Http\Controllers\Vendor\ProductQAController::class,'update'])->name('vproductqa.update');
    // Order
    Route::resource('/order',\App\Http\Controllers\Vendor\OrderController::class);
    Route::get('order/pdf/{id}',[\App\Http\Controllers\Vendor\OrderController::class,'pdf'])->name('vorder.pdf');

    // Profile
    Route::get('/profile',[\App\Http\Controllers\Vendor\VendorController::class,'profile'])->name('vendor.profile');
    Route::post('/profile/{id}',[\App\Http\Controllers\Vendor\VendorController::class,'profileUpdate'])->name('vendor-profile-update');

});

// User section start
Route::group(['prefix'=>'/user','middleware'=>['auth','user']],function(){
    Route::get('/dashboard',[\App\Http\Controllers\HomeController::class,'index'])->name('user');
    
    // Profile
     Route::get('/profile',[\App\Http\Controllers\HomeController::class,'profile'])->name('user-profile');
     Route::post('/profile/{id}',[\App\Http\Controllers\HomeController::class,'profileUpdate'])->name('user-profile-update');
    
     //  Order
    Route::get('/order',[\App\Http\Controllers\HomeController::class,'orderIndex'])->name('user.order.index');
    Route::get('/order/show/{id}',[\App\Http\Controllers\HomeController::class,"orderShow"])->name('user.order.show');
    Route::delete('/order/delete/{id}',[\App\Http\Controllers\HomeController::class,'userOrderDelete'])->name('user.order.delete');
    
    // Product Review
    Route::get('/user-review',[\App\Http\Controllers\HomeController::class,'productReviewIndex'])->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}',[\App\Http\Controllers\HomeController::class,'productReviewDelete'])->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}',[\App\Http\Controllers\HomeController::class,'productReviewEdit'])->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}',[\App\Http\Controllers\HomeController::class,'productReviewUpdate'])->name('user.productreview.update');
    
    // Post comment
    Route::get('user-post/comment',[\App\Http\Controllers\HomeController::class,'userComment'])->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}',[\App\Http\Controllers\HomeController::class,'userCommentDelete'])->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}',[\App\Http\Controllers\HomeController::class,'userCommentEdit'])->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}',[\App\Http\Controllers\HomeController::class,'userCommentUpdate'])->name('user.post-comment.update');
    
    // Password Change
    Route::get('change-password', [\App\Http\Controllers\HomeController::class,'changePassword'])->name('user.change.password.form');
    Route::post('change-password', [\App\Http\Controllers\HomeController::class,'changPasswordStore'])->name('change.password');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});