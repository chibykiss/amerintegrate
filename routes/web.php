<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\PaystackWebhookController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\WebsiteSetupController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AuthController::class, 'showLogin'])->name('login')->middleware('guest:admin');
Route::post('/login', [AuthController::class, 'Login'])->name('admin.login');
Route::post('/paystack/webhook', [PaystackWebhookController::class, 'handlechargesucess'])->middleware('verifywebhook');

Route::group(["middleware" => ["auth:admin"]], function(){
    Route::get('/logout', [AuthController::class, 'Logout'])->name('admin.logout');
     Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
     Route::post('/post/upload', [PostController::class,'ckupload'])->name('ckeditor.upload');
     Route::get('/video/create', [VideoController::class,'create'])->name('video.create');
     Route::get('/video', [VideoController::class,'index'])->name('video.index');
     Route::post('/video', [VideoController::class,'store'])->name('video.store');
     Route::get('/video/{video}/publish', [VideoController::class,'publish'])->name('video.publish');
     Route::delete('/video/{video}', [VideoController::class,'destroy'])->name('video.destroy');
     Route::get('/mail/subscribers', [NewsletterController::class, 'allSubscribers'])->name('email.subscribers');
     Route::get('/mail/{mail?}/create', [NewsletterController::class,'createSingle'])->name('email.create');
     Route::post('/mail/send', [NewsletterController::class,'sendEmail'])->name('email.send');
     Route::post('/mail/sendbulk', [NewsletterController::class,'sendBulk'])->name('email.sendbulk');
     Route::post('/mail/resend', [NewsletterController::class,'Resend'])->name('email.resend');
   //   Route::get('/post/publish', [PostController::class, 'publishPost']);
     Route::resources([
        '/post' => PostController::class,
        '/event' => EventController::class,
        '/mail' => NewsletterController::class,
        '/faq' => FaqController::class,
        '/service' => ServiceController::class,
        '/team' => TeamController::class,
        '/setup' => WebsiteSetupController::class,
     ]);

     Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation.index');
     Route::get('/consultation/{id}', [ConsultationController::class, 'approve'])->name('consultation.approve');
     Route::get('/consultation/{email}/create', [ConsultationController::class, 'consultEmail'])->name('consultation.email');
     Route::post('/consultation', [ConsultationController::class, 'sendConsultEmail'])->name('consultation.emailstore');
     Route::resource('admin', AdminController::class)->middleware('can:manage-admin');
     Route::get('/donation', DonationController::class)->middleware('can:manage-admin')->name('admin.donation');
});


