<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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


Route::get('/storage-bucket', function (Request $request) {
    $path = $request->query('path');
    if (file_exists(storage_path('app/public/' . $path))) {
        return response()->file(storage_path('app/public/' . $path));
    }

    return abort(404);
});

Route::get('/', [AuthController::class, 'index'])->middleware('auth.redirect');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'checkauth'], function () {
    Route::get('delete-product-image/{id}', [ProductController::class, 'destroyImage']);
    Route::resource('product', ProductController::class);
});
