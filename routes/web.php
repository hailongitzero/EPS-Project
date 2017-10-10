<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function (){
    Route::get('/tai-lieu/{id}', 'DocumentController@dsDanhMucTheoTo');

    Route::get('themDanhMuc', 'DocumentController@themMoiDanhMuc');
    Route::post('themDanhMuc', 'DocumentController@themMoiDanhMuc');

    Route::post('danh-sach-tai-lieu', 'DocumentController@dsTaiLieuTheoDanhMuc');
    Route::get('danh-sach-tai-lieu', 'DocumentController@dsTaiLieuTheoDanhMuc');

    Route::get('/tai-lieu/{id}/danh-muc/{id-danh-muc}', 'DocumentController@dsTaiLieuTheoDanhMucTo');

    Route::get('/downloadTaiLieu/{id}', 'DocumentController@downloadTaiLieu');

    Route::post('/uploadTaiLieu', 'DocumentController@uploadTaiLieu');
    Route::get('uploadTaiLieu', 'DocumentController@uploadTaiLieu');
});