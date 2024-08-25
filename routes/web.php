<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\emailcontroller;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::get('/register',[Authcontroller::class,'register'])->name('auth.register');
Route::post('/handelregister',[Authcontroller::class,'handelregister'])->name('auth.handelregister');

Route::get('/login',[Authcontroller::class,'login'])->name('auth.login');
Route::post('/handellogin',[Authcontroller::class,'handellogin'])->name('auth.handellogin');

Route::get('/logout',[Authcontroller::class,'logout'])->name('auth.logout');
////////////////////////////////////////////////////////////////

Route::get('/auth/redirectgoog',[authcontroller::class,'redirectgoog'])->name('users.redirectgoog');    
Route::get('/auth/callbackgoog',[authcontroller::class,'callbackgoog'])->name('users.callbackgoog');

////////////////////////////////////

Route::get('/send',[emailcontroller::class,'send']);


/////////////////////////////////////////////////////////////////////////////////////
Route::get('/index',[GameController::class,'index'])->name('games.index');

Route::get('/index/show/{id}',[GameController::class,'show'])->name('games.show');





Route::middleware('isAdmin')->group(function(){
    Route::get('/create',[GameController::class,'create'])->name('games.create');
    Route::post('/store',[GameController::class,'store'])->name('games.store');
    
    Route::get('/update/{id}',[GameController::class,'update'])->name('games.update');
    Route::post('/edit/{id}',[GameController::class,'edit'])->name('games.edit');
    Route::get('/delete/{id}',[GameController::class,'delete'])->name('games.delete');

});

///////////////////////////////////////////////


Route::post('/comment/store/{id}',[GameController::class,'storecomment'])->name('comments.store');

Route::get('/comment/delete/{id}',[GameController::class,'deletecomment'])->name('comments.delete');




Route::get('cate/index',[CategoryController::class,'index'])->name('categories.index');

Route::get('/cate/create',[CategoryController::class,'create'])->name('categories.create');
Route::post('/cate/store',[CategoryController::class,'store'])->name('categories.store');


Route::post('/cart/add/{id}',[GameController::class,'add'])->name('cart.add');

Route::get('/cart', [GameController::class,'cart'])->name('cart.view');

Route::post('/cart,remove/{id}', [GameController::class,'Remove'])->name('cart.remove');

Route::get('/cart/buy',[GameController::class,'buy'])->name('cart.buy');

