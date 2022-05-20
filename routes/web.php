<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontEndController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\DonationController;
use App\Http\Controllers\Backend\DonationCauseController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Middleware\Admin;
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
  
Route::controller(FrontEndController::class)->group(function () {
    
    Route::get('/', 'index');
    Route::get('/about', 'about');
    Route::get('/contact', 'contact');
    Route::get('/donate', 'donate');
    Route::get('/products', 'allProducts');
    Route::get('/privacy-policy', 'privacyPolicy');
    Route::get('/product/{slug}', 'singleProduct');
    Route::post('/subscribeToNewsletter', 'subscribeToNewsletter');
    Route::post('/submitContactForm', 'submitContactForm');
    Route::post('/updateProfile', 'updateProfile');

    Route::middleware(['auth'])->group(function () {
        Route::get('/myOrders', 'myOrders');
        Route::post('/submitDonation', 'submitDonation');
        Route::get('/myAddresses', 'myAddresses');
        Route::get('/myProfile', 'myProfile');
        Route::post('/placeCartOrder', 'placeCartOrder');
        Route::post('/placeDirectOrder', 'placeDirectOrder');
        Route::get('/checkout', 'checkout')->middleware(['checkout','checkAddress']);
        Route::get('/myCart', 'myCart'); 
        Route::get('/changePassword', 'changePasswordView');  
        Route::get('/myDonations', 'myDonations'); 
        Route::post('/changePassword', 'changePassword'); 
        Route::post('/addMyAddress', 'addMyAddress'); 
        Route::post('/addressSelect', 'addressSelect');
        Route::post('/addToCart', 'addToCart');
        Route::post('/cart/increase', 'increaseQuantity');
        Route::post('/cart/decrease', 'decreaseQuantity');
        Route::post('/cart/remove', 'removeItem');
    });

});
 
 
Route::middleware([Admin::class])
->controller(AdminController::class)
->group(function () {
    Route::get('/admin/dashboard', 'dashboard');
    Route::get('/admin/donation', 'donation');
});

Route::middleware([Admin::class])
->controller(ProductController::class)
->group(function () {

    Route::get('/admin/product', 'index');
    Route::get('/admin/product/create', 'create');
    Route::post('/admin/product/featuredStatus', 'changeFeaturedStatus');
    Route::post('/admin/product/store', 'store');
    Route::get('/admin/product/edit/{id}', 'edit');
    Route::post('/admin/product/update', 'update');
    Route::post('/admin/product/delete/{id}', 'delete');

});
 
 
Route::middleware([Admin::class])
->controller(AboutController::class)
->group(function () {
    Route::get('/admin/about', 'index');
    Route::post('/admin/about/update', 'update');
});
 
 
Route::middleware([Admin::class])
->controller(SiteSettingController::class)
->group(function () {
    Route::get('/admin/site-setting', 'index');
    Route::post('/admin/site-setting/update', 'update');
});
 
 
 
Route::middleware([Admin::class])
->controller(OrderController::class)
->group(function () {

    Route::get('/download/invoice/{order_id}', 'download_invoice');
    Route::get('/admin/order', 'index');
});
 
 
Route::middleware([Admin::class])
->controller(ProductCategoryController::class)
->group(function () {

    Route::get('/admin/productCategory', 'index');
    Route::get('/admin/productCategory/create', 'create');
    Route::post('/admin/productCategory/store', 'store');
    Route::get('/admin/productCategory/edit/{id}', 'edit');
    Route::post('/admin/productCategory/update/{id}', 'update');
    Route::post('/admin/productCategory/delete/{id}', 'delete');

});
 
 
Route::middleware([Admin::class])
->controller(BannerController::class)
->group(function () {
    Route::get('/admin/banner', 'index');
    Route::get('/admin/banner/create', 'create');
    Route::post('/admin/banner/store', 'store');
    Route::get('/admin/banner/edit/{id}', 'edit');
    Route::post('/admin/banner/update/{id}', 'update');
    Route::post('/admin/banner/delete/{id}', 'delete');
});
 
Route::middleware([Admin::class])
->controller(DonationController::class)
->group(function () {
    Route::get('/admin/donation', 'index');
    Route::get('/admin/donation/create', 'create');
    Route::post('/admin/donation/store', 'store');
    Route::get('/admin/donation/edit/{id}', 'edit');
    Route::post('/admin/donation/update/{id}', 'update');
    Route::post('/admin/donation/delete/{id}', 'delete');
});
 
Route::middleware([Admin::class])
->controller(DonationCauseController::class)
->group(function () {
    Route::get('/admin/donationCause', 'index');
    Route::get('/admin/donationCause/create', 'create');
    Route::post('/admin/donationCause/store', 'store');
    Route::get('/admin/donationCause/edit/{id}', 'edit');
    Route::post('/admin/donationCause/update/{id}', 'update');
    Route::post('/admin/donationCause/delete/{id}', 'delete');
});

Route::get('/stripe', [DonationController::class, 'stripe']); 
 
Route::middleware([Admin::class])
->controller(UserController::class)
->group(function () {
    Route::get('/admin/user', 'index');
    Route::get('/admin/user/create', 'create');
    Route::post('/admin/user/store', 'store');
    Route::get('/admin/user/edit/{id}', 'edit');
    Route::post('/admin/user/update/{id}', 'update');
    Route::post('/admin/user/delete/{id}', 'delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
