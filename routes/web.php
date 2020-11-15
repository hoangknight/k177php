<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
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


Route::get('/', function () {
    return view('backend.index');
});

// Frontend Route

Route::group(['prefix' => '/', 'namespace' =>'Site'], function() {

    Route::group(['prefix' => 'san-pham','namespace' => 'Products'], function() {
        Route::get('/', 'ProductController@shop')->name('shop');
        Route::get('/{slug}.html', 'ProductController@detail')->name('shop.detail');
        Route::get('/tim-kiem', 'ProductController@filter')->name('shop.filter');
    });
    Route::group(['prefix' => 'danh-muc','namespace' => 'Category'], function() {
        Route::get('{cate_slug}.html', 'CategoryController@index')->name('cate.index');
    });

    Route::group(['prefix' => 'gio-hang','namespace'=>'Cart'], function() {
        Route::get('/', 'CartController@cart')->name('cart');
        Route::get('/them-gio-hang', 'CartController@addToCart')->name('cart.add');
        Route::get('/thanh-toan.html', 'CartController@checkout')->name('cart.checkout');
        Route::post('/thanh-toan', 'CartController@payment')->name('cart.payment');
        Route::get('/hoan-thanh.html', 'CartController@complete')->name('cart.complete');
        Route::get('/cap-nhat-gio-hang/{rowId}/{qty}','CartController@update')->name('cart.update');
        Route::get('/xoa-san-pham/{rowId}','CartController@delete')->name('cart.delete');

    });

    Route::get('/lien-he.html', 'SiteController@contact')->name('contact');
    Route::get('/ve-chung-toi.html', 'SiteController@about')->name('about');
    Route::get('/', 'SiteController@index')->name('index');

});



// Backend Route

Route::get('/login','Admin\Auth\LoginController@login')->name('login')->middleware('CheckLogout');
Route::post('/login','Admin\Auth\LoginController@postLogin');

Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
    });
Route::group(['prefix'=>'admin','namespace' => 'Admin','middleware'=>'CheckLogin'], function() {
    Route::get('/logout','AdminController@logout')->name('logout');
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::group(['prefix' => 'user','namespace' => 'User'], function() {
        Route::get('/', 'UserController@index')->name('user.index');
        Route::get('/detail/{id}', 'UserController@detail')->name('user.detail');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('/store', 'UserController@store')->name('user.store');
        Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('/update/{id}', 'UserController@update')->name('user.update');
        Route::get('/delete/{id}', 'UserController@delete')->name('user.delete');
    });
    Route::group(['prefix' => 'product','namespace' => 'Products'], function() {
        Route::get('/', 'ProductController@index')->name('product.index');
        Route::get('/create', 'ProductController@create')->name('product.create');
        Route::post('/store', 'ProductController@store')->name('product.store');
        Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::post('/update/{id}', 'ProductController@update')->name('product.update');
        Route::get('/delete/{id}', 'ProductController@delete')->name('product.delete');
    });
    // Category
    Route::group(['prefix' => 'category','namespace' => 'Category'], function() {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::get('/detail/{id}', 'CategoryController@detail')->name('category.detail');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::post('/update/{id}', 'CategoryController@update')->name('category.update');
        Route::get('/delete/{id}', 'CategoryController@delete')->name('category.delete');
    });
    Route::group(['prefix' => 'order','namespace' => 'Order'], function() {
        Route::get('/', 'OrderController@orders')->name('order.order');
        Route::get('/detail/{orderId}', 'OrderController@detail')->name('order.detail');
        Route::get('/approved/{orderId}', 'OrderController@approve')->name('order.approved');
        Route::get('/processed', 'OrderController@processed')->name('order.processed');
    });
});

// Schema - Migration - Seeder

// Route::group(['prefix' => 'schema'], function(){
// 	// create table
// 	Route::get('create-user', function(){
// 		Schema::create('users', function($table){
// 			$table->increments('id');
// 			$table->string('fullname',100);
// 			$table->string('address', 255)->nullable();
// 			$table->string('phone')->default('0395954444');
// 			$table->tinyInteger('level')->unsigned();
// 			$table->timestamps();
// 		});
// 	});

// 	// rename table name
// 	Route::get('rename', function(){
// 		Schema::rename('user', 'users');
// 	});
// 	// delete table
// 	Route::get('drop-table', function(){
// 		Schema::dropIfExists('users');
// 	});

// 	// Add a new column
// 	Route::get('add-email', function(){
// 		Schema::table('users', function($table){
// 			$table->string('email')->after('fullname');
// 		});
// 	});

// });

// Query Builder


Route::group(['prefix' => 'query'], function(){
    // Lấy dữ liệu từ trong CSDL => bảng users

    Route::get('/get-users', function(){
        $users = DB::table('users')->get();
        echo "<pre>";
        print_r($users);
    });
    // select
    Route::get('/get-phone-email', function(){
        $users = DB::table('users')->select('phone','email')->get();
        echo "<pre>";
        print_r($users);
    });

    //where

    Route::get('/get-where', function(){
        $users = DB::table('users')->where('level',1)->get();
        echo "<pre>";
        print_r($users);
    });

    Route::get('/get-where-level-less-than-2', function(){
        $users = DB::table('users')->where('level','<>',1)->get();
        echo "<pre>";
        print_r($users);
    });
    // orWhere
    Route::get('/get-where-or-where', function(){
        $users = DB::table('users')->where('level','<>',1)->orWhere('fullname','Administrator')->get();
        echo "<pre>";
        print_r($users);
    });
    // Where-like
    Route::get('/get-where-like', function(){
        $users = DB::table('users')->where('address','LIKE','%Bà Trưng%')->get();
        echo "<pre>";
        print_r($users);
    });

    // Join

    Route::get('/join-table',function(){
        $users = DB::table('users')
                ->join('info','users.id','=','info.users_id')
                ->select('users.fullname','info.cmt')
                ->get();
        echo "<pre>";
        print_r($users);
    });
    // LeftJoin

    Route::get('/left-join-table',function(){
        $users = DB::table('users')
                ->leftjoin('info','users.id','=','info.users_id')
                ->select('users.fullname','info.cmt')
                ->get();
        echo "<pre>";
        print_r($users);
    });

    // orderBy
     Route::get('/order-by',function(){
        $users = DB::table('users')
                ->orderBy('id','desc')
                ->get();
        echo "<pre>";
        print_r($users);
    });

     // Insert data to database

     Route::get('/insert', function(){
        $success = false;
        $data = ['id'=>4, 'fullname' => 'Dev04', 'email' => 'dev04@gmail.com', 'phone' => '0395954444', 'level' => 1];

        DB::table('users')->insert($data);
        $success = true;

        if($success == true){
            echo "Insert dữ liệu thành công";
        }
     });

     // Update data
    Route::get('/update/{id}', function($id){
        $success = false;

        $data = ['fullname' => 'Dev03', 'email' => 'dev34@gmail.com'];

        DB::table('users')->where('id',$id)->update($data);

        $success = true;

        if($success == true){
            echo "Update dữ liệu thành công";
        }
     });
    // Delete data
    Route::get('/delete/{id}', function($id){
        $success = false;
        DB::table('users')->where('id',$id)->delete();

        $success = true;

        if($success == true){
            echo "Xóa dữ liệu thành công";
        }
     });

});


// ORM
