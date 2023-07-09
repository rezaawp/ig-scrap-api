<?php

use App\Http\Controllers\Api\InstagramController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(InstagramController::class)->group(function () {
    Route::prefix('ig')->group(function () {
        Route::get('/get-media-photo', 'getMediaPhotoByUrl');
        Route::get('/profile-picture', 'getProfilePicture');
        Route::get('/get-ff-account', 'followersAndFollowings');
        Route::get('/get-highlights', 'getHighlights');
    });
});
