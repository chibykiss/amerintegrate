<?php

use App\Http\Controllers\Api\AddsubscriberController;
use App\Http\Controllers\Api\BookConsultationController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\GetFaqController;
use App\Http\Controllers\Api\PaypalStorePaymentDetailsController;
use App\Http\Controllers\Api\PaystackConfirmPaymentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SendContactController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\WebsiteSetupController;
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
Route::get('/event', [EventController::class, 'index']);
Route::get('/event/past', [EventController::class, 'getPastEvents']);
Route::get('/event/global', [EventController::class, 'getGlobalEvents']);
Route::get('/event/future', [EventController::class, 'getFutureEvents']);
Route::get('/event/{event}', [EventController::class, 'show']);
Route::get('/post/latest', [PostController::class, 'latest']);
Route::get('/post', [PostController::class, 'index']);
Route::get('/post/{post}', [PostController::class, 'show']);
Route::post('/comment', [CommentController::class,'store']);
Route::post('/comment/reply', [CommentController::class,'reply']);
Route::post('/subscriber', AddsubscriberController::class);
Route::post('/book', BookConsultationController::class);
Route::post('/contact', SendContactController::class);
Route::get('/faq', GetFaqController::class);
Route::get('/video', [VideoController::class,'index']);
Route::get('/video/{video}', [VideoController::class,'show']);
Route::get('/service/name', [ServiceController::class, 'getServiceName']);
Route::get('/service', [ServiceController::class, 'index']);
Route::get('/team', [TeamController::class, 'index']);
Route::get('/web-address', [WebsiteSetupController::class, 'Address']);
Route::get('/vis_location', [WebsiteSetupController::class, 'visitor_location']);
Route::get('/paystack-verify', PaystackConfirmPaymentController::class);
Route::post('/paypal-store', PaypalStorePaymentDetailsController::class);