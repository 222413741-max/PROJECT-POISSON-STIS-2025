<?php

use App\Http\Controllers\AWS;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/presigned-aws', [AWS::class, 'create']); 

Route::post('/midtrans-verify', [\App\Http\Controllers\MidtransController::class, 'callback'])->name('midtrans_verify');

Route::get('/translations/{lng}', function ($lng) {
    $path = resource_path("../resources/lang/json/{$lng}.json");

    if (!file_exists($path)) {
        abort(404, 'Translation file not found.');
    }

    return response()->file($path);
});