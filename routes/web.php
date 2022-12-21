<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;

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

Route::group(['prefix' => ''], function () {
    Route::get('/', [PagesController::class, 'index'])->name('home.index');
    Route::get('/shop', [PagesController::class, 'shop'])->name('shop.index');
    Route::get('/shop/{id}', [PagesController::class, 'shop_cate'])->name('shop.shop_cate');
    Route::get('/detail/{id}', [PagesController::class, 'detail'])->name('shop.detail');

    Route::prefix('/cart')->group(function () {
        Route::get('/', [CartController::class, 'show'])->name('shop.show_cart')->middleware('user');
        Route::post('/{id}', [CartController::class, 'add_to_cart'])->name('shop.cart');
        Route::post('/update/{id}', [CartController::class, 'update_cart'])->name('shop.update_cart');
        Route::get('/delete/{id}', [CartController::class, 'delete'])->name('shop.delete_cart');
    });

    Route::prefix('/user')->group(function () {

        Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

        Route::get('/sign-up', [PagesController::class, 'sign_up'])->name('user.sign-up');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');

        Route::get('/sign-in', [UserController::class, 'sign_in'])->name('user.sign-in');
        Route::post('/login', [UserController::class, 'login'])->name('user.login');

        Route::get('/sign-out', [UserController::class, 'sign_out'])->name('user.sign-out');
    });
});


Route::middleware('admin')->prefix("admin")->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/category/recycle-bin', [CategoryController::class, 'recycle_bin'])->name('category.recycle_bin');
    Route::get('/category/restore/{id}', [CategoryController::class, 'restored'])->name('category.restore');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'force_delete'])->name('category.force_delete');

    Route::get('/product/recycle-bin', [ProductController::class, 'recycle_bin'])->name('product.recycle_bin');
    Route::get('/product/restore/{id}', [ProductController::class, 'restored'])->name('product.restore');
    Route::delete('/product/delete/{id}', [ProductController::class, 'force_delete'])->name('product.force_delete');

    Route::get('/account/recycle-bin', [AccountController::class, 'recycle_bin'])->name('account.recycle_bin');
    Route::get('/account/restore/{id}', [AccountController::class, 'restored'])->name('account.restore');
    Route::delete('/account/delete/{id}', [AccountController::class, 'force_delete'])->name('account.force_delete');

    Route::resources([
        'category' => CategoryController::class,
        'product' => ProductController::class,
        'account' => AccountController::class
    ]);
});

Route::get('/logon', [UserController::class, 'logon'])->name('admin.logon');
Route::post('/logon', [UserController::class, 'doLogon'])->name('admin.logon');
