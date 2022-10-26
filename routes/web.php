<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get( '/', [HomeController::class, 'index'])->name('home.index');
Route::post('/',[HomeController::class, 'store'])->name('home.store');
Route::get('/{id}/delete',[HomeController::class,'destory'])->name('home.destory');
Route::get('/{id}/download',[HomeController::class,'download'])->name('home.download');
Route::get('/lang/', function () {
    return view('lang');
});

Route::get('/lang/{local}', function ($local) {
    App()->setlocale($local);
    return view('lang');
});

Route::view('/review','review')->middleware('auth');
Route::post('/review-create',[ReviewController::class,'store'])->middleware('auth')->name('review.store');


Route::middleware(['auth','isAdmin'])->group(function(){

    Route::get('/admin',[AdminController::class,'index']);
    Route::get('/admin/user-ssd',[AdminController::class,'ssd']);
    Route::get('/admin/delete/{id}',[AdminController::class,'destroy'])->name('admin.user-delete');
});