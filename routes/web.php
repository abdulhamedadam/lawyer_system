<?php


use App\Http\Controllers\ZatcaTestController;
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
    return view('coming-soon');
})->name('home');
Route::group(['middleware' => ['auth:web']], function () {




});

require __DIR__ . '/auth.php';
