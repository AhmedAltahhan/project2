<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\PurchaseController;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'guest'] , function()
{
    Route::post('/login',[AuthController::class ,'login']);
    Route::post('/register',[AuthController::class ,'register']);
    Route::put('/verify/{id}',[AuthController::class ,'verify']);
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('packages',PackageController::class);
    Route::apiResource('courses',CourseController::class);
    Route::get('/purchases',[PurchaseController::class ,'all']);
    Route::post('/purchases',[PurchaseController::class ,'create']);
    Route::get('purn',[AuthController::class,'purn'])->name('purn');

});


