<?php

use App\Http\Controllers\Office\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Office\OfficeContoller;
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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {


    Route::group(['middleware' => ['auth:office'], 'prefix' => 'office', 'as' => 'office.'], function () {
        Route::get('dashboard', function () {
            return view('office.dashboard');
        })->name('office.dashboard');
//        Route::resource('office',OfficeContoller::class);

        Route::get('profile_1', [ProfileController::class, 'edit'])->name('profile_1.edit');
        Route::patch('profile_1', [ProfileController::class, 'update'])->name('profile_1.update');
        Route::get('edit_profile',[OfficeContoller::class,'show_profile'])->name('edit_profile');
        Route::patch('profile_update',[OfficeContoller::class,'profile_update'])->name('profile_update');
        Route::patch('password_update',[OfficeContoller::class,'password_update'])->name('password_update');
        Route::get('all_units',[OfficeContoller::class,'all_units'])->name('all_units');
        Route::get('add_units',[OfficeContoller::class,'create_unit'])->name('create_unit');
        Route::post('add_units',[OfficeContoller::class,'add_units'])->name('add_units');
        Route::get('edit_unit/{id}',[OfficeContoller::class,'edit_unit'])->name('edit_unit');
        Route::patch('update_unit',[OfficeContoller::class,'update_unit'])->name('update_unit');
        Route::get('unit_media/{id}',[OfficeContoller::class,'unit_media'])->name('unit_media');
        Route::post('upload_img',[OfficeContoller::class,'upload_img'])->name('upload_img');
        Route::delete('destroy_image/{id}',[OfficeContoller::class,'destroy_image'])->name('destroy_image');
        Route::get('block_days/{id}',[OfficeContoller::class,'block_days'])->name('block_days');
        Route::post('store_block_days',[OfficeContoller::class,'store_block_days'])->name('store_block_days');
        Route::delete('{id}/delete_day',[OfficeContoller::class,'delete_day'])->name('delete_day');

        /*-----------------------------------------------*/
        Route::get('{unit_id}/delete_unite', [OfficeContoller::class, 'delete_unite'])->name('delete_unite');

        Route::delete('{unit_id}/delete_review', [OfficeContoller::class, 'delete_review'])->name('delete_review');
        Route::get('{unit_id}/show_orders', [OfficeContoller::class, 'show_orders'])->name('show_orders');
        Route::get('{unit_id}/show_reviews', [OfficeContoller::class, 'show_reviews'])->name('show_reviews');

        /*-----------------------------------------------*/



        Route::get('edit_data', [OfficeContoller::class, 'edit'])->name('get_data');
        Route::post('edit_data', [OfficeContoller::class, 'update'])->name('edit_data');

        Route::post('/get_quarter_list', [SettingController::class, 'get_quarter_list'])->name('get_quarter_list');
        Route::post('/get_city_list', [SettingController::class, 'get_city_list'])->name('get_city_list');
        Route::post('/get_city', [SettingController::class, 'get_city'])->name('get_city');
        Route::post('/get_emara', [SettingController::class, 'get_emara'])->name('get_emara');

    });

    require __DIR__ . '/hostauth.php';
});



