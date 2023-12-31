<?php

use App\Http\Controllers\Admin\AdminTeamController;
use App\Http\Controllers\Admin\CollegesController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SportsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\athelte\AtheleteController;
use App\Http\Controllers\coach\PLayerController;
use App\Http\Controllers\coach\PlayerInTeamController;
use App\Http\Controllers\coach\PostController;
use App\Http\Controllers\coach\TeamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

//Profile
Route::resource('profile',ProfileController::class);

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('logout', [LoginController::class, 'logout']);

// Route::get('payment-paypal', [PaypalController::class,'postPaymentWithpaypal'])->name('payment-paypal')->middleware('auth');
// Route::get('status', [PaypalController::class,'getPaymentStatus'])->name('status')->middleware('auth');

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
Route::post('vendor/register',[FrontendController::class,'institute_register'])->name('institute_register.submit');
// Reset password
Route::post('password-reset', [FrontendController::class,'showResetForm'])->name('password.reset');

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
// Route::post('/contact/message',[\App\Http\Controllers\MessageController::class,'store'])->name('contact.store');
Route::get('product-detail/{slug}',[FrontendController::class,'productDetail'])->name('product-detail');
Route::get('/product-review-fetch/{slug}/{id}',[FrontendController::class,'product_review_fetch'])->name('product-review-fetch');
Route::post('/product/search',[FrontendController::class,'productSearch'])->name('product.search');
Route::get('/product-cat/{slug}',[FrontendController::class,'productCat'])->name('product-cat');
Route::get('/product-sub-cat/{slug}',[FrontendController::class,'productSubCat'])->name('product-sub-cat');
Route::get('/product-brand/{slug}',[FrontendController::class,'productBrand'])->name('product-brand');
// Cart section
// Route::get('/add-to-cart/{slug}',[\App\Http\Controllers\CartController::class,'addToCart'])->name('add-to-cart')->middleware('user');
// Route::post('/add-to-cart',[\App\Http\Controllers\CartController::class,'singleAddToCart'])->name('single-add-to-cart')->middleware('user');
// Route::get('cart-delete/{id}',[\App\Http\Controllers\CartController::class,'cartDelete'])->name('cart-delete');
// Route::post('cart-update',[\App\Http\Controllers\CartController::class,'cartUpdate'])->name('cart.update');


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
Route::group(['prefix'=>'manage','middleware'=>['auth']],function(){
    //Search College
    Route::get('/searchcollege',[AtheleteController::class,'searchPage'])->name('searchcollege.index');
    Route::get('/searchcolleges',[AtheleteController::class,'searchcollege'])->name('searchcollege.search');
    Route::get('/showcolleges/{id}',[AtheleteController::class,'showchcollege'])->name('searchcollege.show');
    Route::get('/showcollegesCoach/{id}',[AtheleteController::class,'showcollegesCoach'])->name('showcollegesCoach.show');

    //Search Coach
    Route::get('/searchCoach',[AtheleteController::class,'searchPageCoach'])->name('searchCoach.index');
    Route::get('/searchCoachs',[AtheleteController::class,'searchCoach'])->name('searchCoach.search');
    Route::get('/showCoachs/{id}',[AtheleteController::class,'showchCoach'])->name('searchCoach.show');
});

Route::group(['prefix'=>'admin','middleware'=>['auth','role:admin']],function(){
    Route::get('/dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('admin.dashboard');



    Route::resource('roles', RoleController::class);
    Route::resource('permission', PermissionController::class);

    Route::resource('college',CollegesController::class);
    Route::post('/upload',[CollegesController::class,'uploadCsv'])->name('upload.csv');
    Route::get('adminCoach/{id}',[CollegesController::class,'coaches'])->name('adminCoach');
    Route::post('adminCoachsave',[CollegesController::class,'adminCoachsave'])->name('adminCoachsave');
    Route::controller(CollegesController::class)->group(function () {
        Route::get('coach/data', 'data')->name('coach.data');
        Route::get('coach/data/{id}', 'Editdata')->name('data.edit');
        Route::put('coach/update/{id}', 'updatedata')->name('data.update');
        Route::delete('coach/data/delete/{id}', 'Deletedata')->name('data.destroy');
    });

    Route::resource('sport',SportsController::class);
    Route::get('sport/field/{id}',[SportsController::class,'fields'])->name('field.delete');
    Route::get('sport/stats/{id}',[SportsController::class,'stats'])->name('stats.delete');
    //Posts
    Route::resource('post',PostController::class);
    // user route
    Route::resource('users',UsersController::class);
    // vendor route
    Route::resource('vendors',\App\Http\Controllers\VendorsController::class);

     //Teams
     Route::resource('teams',AdminTeamController::class);


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






// college
Route::group(['prefix'=>'/college','middleware'=>['auth','role:college']],function(){
    Route::get('/dashboard',[\App\Http\Controllers\Vendor\DashboardController::class,'index'])->name('college.dashboard');

});

// athelete section start
Route::group(['prefix'=>'/athelete','middleware'=>['auth','role:athelete']],function(){
    Route::get('/dashboard',[HomeController::class,'index'])->name('athelete.dashboard');

    Route::get('/accept/{id}', [AtheleteController::class, 'acceptteam'])->name('athelte.accept');
    Route::get('/decline/{id}', [AtheleteController::class, 'declineteam'])->name('athelte.decline');
    Route::get('/teams', [AtheleteController::class, 'team'])->name('team');

    Route::resource('athlete',AtheleteController::class);
    Route::resource('user_profile',UserProfileController::class);

    // Profile
    //  Route::get('/profile',[\App\Http\Controllers\HomeController::class,'profile'])->name('user-profile');
    //  Route::post('/profile/{id}',[\App\Http\Controllers\HomeController::class,'profileUpdate'])->name('user-profile-update');

    //  //  Order
    // Route::get('/order',[\App\Http\Controllers\HomeController::class,'orderIndex'])->name('user.order.index');
    // Route::get('/order/show/{id}',[\App\Http\Controllers\HomeController::class,"orderShow"])->name('user.order.show');
    // Route::delete('/order/delete/{id}',[\App\Http\Controllers\HomeController::class,'userOrderDelete'])->name('user.order.delete');

    // // Product Review
    // Route::get('/user-review',[\App\Http\Controllers\HomeController::class,'productReviewIndex'])->name('user.productreview.index');
    // Route::delete('/user-review/delete/{id}',[\App\Http\Controllers\HomeController::class,'productReviewDelete'])->name('user.productreview.delete');
    // Route::get('/user-review/edit/{id}',[\App\Http\Controllers\HomeController::class,'productReviewEdit'])->name('user.productreview.edit');
    // Route::patch('/user-review/update/{id}',[\App\Http\Controllers\HomeController::class,'productReviewUpdate'])->name('user.productreview.update');

    // // Post comment
    // Route::get('user-post/comment',[\App\Http\Controllers\HomeController::class,'userComment'])->name('user.post-comment.index');
    // Route::delete('user-post/comment/delete/{id}',[\App\Http\Controllers\HomeController::class,'userCommentDelete'])->name('user.post-comment.delete');
    // Route::get('user-post/comment/edit/{id}',[\App\Http\Controllers\HomeController::class,'userCommentEdit'])->name('user.post-comment.edit');
    // Route::patch('user-post/comment/udpate/{id}',[\App\Http\Controllers\HomeController::class,'userCommentUpdate'])->name('user.post-comment.update');

    // // Password Change
    // Route::get('change-password', [\App\Http\Controllers\HomeController::class,'changePassword'])->name('user.change.password.form');
    // Route::post('change-password', [\App\Http\Controllers\HomeController::class,'changPasswordStore'])->name('change.password');

});

// high_school
Route::group(['prefix'=>'/high_school','middleware'=>['auth','role:high_school']],function(){
    Route::get('/dashboard',[HomeController::class,'high_school'])->name('high_school.dashboard');

});


// coach
Route::group(['prefix'=>'/coach','middleware'=>['auth','role:coach|admin']],function(){
    Route::get('/dashboard',[HomeController::class,'coach'])->name('coach.dashboard');
    Route::get('/colleges',[CollegesController::class,'index'])->name('colleges.dashboard');
    Route::get('/resend/{id}', [PlayerInTeamController::class, 'resend'])->name('invite.resend');

    //Teams
    Route::resource('team',TeamController::class);
    Route::resource('player',PlayerInTeamController::class);
    Route::get('/teams/{id}',[TeamController::class,'team'])->name('coach.team');
    Route::get('/manage-players/edit/{id}',[PLayerController::class,'edit'])->name('index.team')->middleware('checkPermission');
    //Player
    Route::resource('manage-players',PLayerController::class);
    //Posts
    Route::resource('posts',PostController::class);
    //Search
    Route::get('/search',[TeamController::class,'search'])->name('coach.search');
    Route::get('/searchPage',[TeamController::class,'searchPage'])->name('page.search');

});



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
