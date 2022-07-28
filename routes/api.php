<?php

use App\Http\Controllers\v1\DownloadedPodcastsController;
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

Route::prefix('v1')->middleware(['XssSanitizer'])->group(function () {
    Route::post('store-downloaded-podcast', [DownloadedPodcastsController::class, 'store']);
    Route::get('recent-downloaded-podcasts', [DownloadedPodcastsController::class, 'show']);
});
