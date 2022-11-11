<?php

use Illuminate\Support\Facades\Route;

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



// Ecommerce Website
Route::namespace('App\Http\Controllers\Frontend')->group(function(){
   //home eShop
   Route::get('/', 'FrontendController@index');
   //category
   Route::get('/category', 'FrontendController@category');
   //products
   Route::get('/category/{slug}', 'ProductController@viewcategory');
   Route::get('category/{cat_slug}/{prod_slug}','ProductController@viewproduct');
   //cart
   Route::post('add-to-cart','CartController@addProduct');
   //wishlist
   Route::post('add-to-wishlist','WishListController@add');
   //order
   Route::get('my-orders','OrderController@index');
   //whishlist
   Route::get('wishlist','WishListController@index');
   //search
   Route::get('product-list','FrontendController@productList');
   Route::post('searchproduct','FrontendController@searchProduct');

   Route::middleware(['auth'])->group(function(){
      //cart
      Route::get('cart','CartController@viewcart');
      Route::delete('delete-cart','CartController@deleteProduct');
      Route::post('update-cart','CartController@updateCart');

      //checckout
      Route::get('checkout','CheckoutController@index');
      Route::post('place-order','CheckoutController@placeorder');

      //order
      Route::get('view-order/{id}','OrderController@show');

      //wishlist
      Route::delete('delete-wishlist','WishListController@delete');

   });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin pannel
 Route::namespace('App\Http\Controllers\Admin')->middleware(['auth','isAdmin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard','HomeController@index');

     //category
     Route::resource('/categories',CategoryController::class);

     //products
     Route::namespace('Products')->group(function(){
        Route::resource('/products',ProductController::class);
        Route::delete('admin/products/{id}','ProductController@destroy');
           //routes of more images
           Route::get('product/images/create/{id}','ImagesController@create');
           Route::post('product/images/store','ImagesController@store');
           Route::get('product/images/{id}/edit/{id2}','ImagesController@edit');
           Route::post('product/images/update/{id}','ImagesController@update');
           Route::delete('product/images/delete/{id}','ImagesController@destroy');
           //routes of adding color to product
           Route::get('product/color/create/{id}','ColorController@create');
           Route::post('product/color/store','ColorController@store');
           Route::get('product/color/{id}/edit/{id2}','ColorController@edit');
           Route::post('product/color/update/{id}','ColorController@update');
           Route::delete('product/color/delete/{id}','ColorController@destroy');
     });

     //orders
     Route::get('orders','OrderController@index');
     Route::get('view-order/{id}','OrderController@show');
     Route::put('update-order/{id}','OrderController@update');
     Route::get('order-history','OrderController@orderHistory');
     
     //users
     //Admins and users
     Route::get('admins','UserController@admins');
     Route::get('users','UserController@users');
     Route::get('add-user','UserController@create');
     Route::post('add-user','UserController@store');
     Route::get('users/{id}','UserController@edit');
     Route::put('users/{id}','UserController@update');
     //my info
     Route::resource('users/myInfo',MyInfoController::class)->except(['delete']);

     //settings
     Route::namespace('settings')->prefix('settings')->group(function(){
        //information
        Route::resource('/info',InfoController::class)->except(['delete']);
        //logo
        Route::resource('/logo',LogoController::class)->except(['delete']);
        //faq
        Route::resource('/faq',FAQController::class);
    });

    //pages
    Route::resource('pages',PagesController::class);

 });
