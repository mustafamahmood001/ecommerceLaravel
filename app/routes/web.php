<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\cartsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\usProfileController;
use App\Models\Product;
use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('index');
})->name('indexWeb');

// AuthenticationController

Route::controller(AuthenticationController::class)->group(function(){
    // Registration view and submit route
    Route::get('registrationform', 'Registrationform')->name('regisform');
    Route::post('registrationform', 'userstore')->name('userstore');
  
    // Loggin view and submit route
    Route::get('loginform', 'loginform')->name('logform');
    Route::post('loginform', 'loginAuthenticate')->name('loginAuthenticate');
     
    // Logout Route
    Route::get('logout', 'logoutAction')->name('logoutRoute');
    
});



Route::middleware(['disable_back_button'])->group(function () {

Route::controller(usProfileController::class)->group(function(){
    Route::get('userprofile','userProfileview')->name('userProfileView');
    Route::get('userprofile/{id}/edit', 'userProfileedit')->name('userprofile.edit');
    Route::post('userprofile/{id}updateprofile','userProfileupdate')->name('userProfileupdate');
    Route::post('userprofile/{id}updatepicture','userPictureupdate')->name('userPictureupdate');
    Route::get('userpassword','userPasswordview')->name('userPasswordview');
    Route::post('userpassword/{id}updatepassword','userPassword')->name('userpasswordupdate');


});
});

Route::group(['prefix' => '/admin', 'middleware'=>['checkrole','disable_back_button']], function(){
 
// user

    Route::controller(adminController::class)->group(function(){
        Route::get('/','indexdashboard')->name('adminhome');
        Route::get('/userdetails','userdetails')->name('userdetails');
        Route::get('/userdetailsedit{id}','edituserdetails')->name('edituserdetails');
        Route::post('/userdetailsupdate/{id}','userProfileupdate')->name('userProfileupdates');
        Route::post('userprofile/{id}updatepicture','userPictureupdate')->name('userPictureupdates');
        Route::get('userprofiledelete/{id}','destroyuserdetails')->name('userdetaildestroy');
        Route::get('userprofileactive/{id}','useractive')->name('useractive');
    
    });
 
//   brands  
    Route::resource('brands', BrandsController::class);
    Route::get('deletebrand/{id}', [BrandsController::class, 'destroyBrand'])->name('destroyBrand');
    Route::post('updatebrandphoto/{id}', [BrandsController::class, 'userPictureupdate'])->name('userPictureupdate');
    Route::get('brandactive/{id}', [BrandsController::class, 'brandactive'])->name('brandactive');

// products
Route::resource('products', ProductController::class);
Route::get('productactive/{id}', [ProductController::class, 'productactive'])->name('productactive');
Route::get('deleteproduct/{id}', [ProductController::class, 'destroyProduct'])->name('destroyProduct');

//Order
Route::controller(OrderController::class)->group(function(){
    Route::get('/orders','indexOrder')->name('indexOrder');
});

});

// Home Products
Route::controller(HomeController::class)->group(function(){
  Route::get('/','productIndex')->name('homes');
  Route::get('/','FilterIndex')->name('homes');
  Route::get('/viewproduct/{product}', 'productsinfo')->name('product_info');
  Route::get('/allproduct', 'productslisting')->name('products_listing');
      
});


// Carts
Route::resource('carts',cartsController::class);

Route::get('/viewcart/{product}', [cartsController::class, 'productsCarts'])->name('products_carts');
Route::post('checkoutforcart', [cartsController::class, 'storeCart'])->name('storeCart');
Route::get('deletecart/{id}', [cartsController::class, 'deleteCart'])->name('deleteCart');

Route::view('testing','test');