<?php

use App\Http\Controllers\AssignPromotionCodeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PromotionCodesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('api_token:admin')->resource('/backoffice/promotion-codes', PromotionCodesController::class);
Route::middleware('api_token:user')->post('/assign-promotion', [AssignPromotionCodeController::class, 'assign']);
