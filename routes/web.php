<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BotmanController;
use App\Http\Controllers\QRController;



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
include 'admin.php';
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'vi', 'cn'])) {
        abort('404');
    }
    session()->put('locale', $locale);
    return redirect()->back();
});
Route::get('/search', [WebController::class, 'search']);
Route::get('/dangxuat',[AuthController::class,'dangxuat']);
Route::middleware(['user'])->group(function() {
    Route::get('/ve/{schedule_id}', [WebController::class, 've']);
    Route::post('/tao_ve', [WebController::class, 'tao_ve']);
    Route::delete('/xoave', [WebController::class, 'xoave']);
 
    Route::post('/taovecombo', [WebController::class, 'taovecombo']);
    Route::delete('/xoavecombo', [WebController::class, 'xoavecombo']);
   
    Route::get('/ticket_discount',[WebController::class,'sudunggiamgia']);
    Route::get('/payment/result', [PaymentController::class, 'handleResult']);
    Route::post('/payment/create', [PaymentController::class, 'create']);
    Route::post('/payment', [PaymentController::class, 'ticketPayment']);


    Route::post('/ticketPaid/image',[WebController::class,'ticketPaid_image']);
    Route::get('/tickets/completed/{id}', [WebController::class, 'ticketCompleted']);


    Route::get('/profile', [WebController::class,'profile']);
    Route::post('/editProfile',[WebController::class,'editProfile']);
    Route::get('/xacthucdoimail', 'WebController@xacthucdoimail');
    Route::post('/changePassword',[WebController::class,'changePassword']);
   
});



Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/chitiet_phim/{id}', [WebController::class, 'chitiet_phim']);
Route::get('/phims', [WebController::class, 'phims']);
Route::get('locphim',[WebController::class,'locphim']);

Route::get('/chitiet_daodien/{id}', [WebController::class, 'chitiet_daodien']);
Route::get('/chitiet_dienvien/{id}',[WebController::class,'chitiet_dienvien']);

Route::get('/tintuc', [WebController::class, 'tintuc']);
Route::get('/chitiet_tintuc/{id}',[WebController::class,'chitiet_tintuc']);
Route::get('/lichtheophim',[WebController::class,'lichtheophim']);

Route::get('/lichtheorap',[WebController::class,'lichtheorap']);


Route::post('/dangnhap', [AuthController::class, 'dangnhap']);
Route::post('/dangky',[AuthController::class,'dangky']);

Route::get('/xacthucemail',[AuthController::class,'xacthucemail']);
Route::post('/quenmatkhau',[AuthController::class,'quenmatkhau']);

Route::get('/generate-qr-code', function () {
    $data = "Hello, world!"; 
    $qrCode = DNS2D::getBarcodePNG($data, 'QRCODE');
    return response()->json(['qr_code' => $qrCode]);
});

// Route::get('/xacthucemail', 'AuthController@xacthucemail');




Route::get('/test', [TestController::class,'index']);
Route::post('/upload', [TestController::class, 'upload']);


Route::match(['get', 'post'], '/botman', [BotmanController::class, 'handle']);

Route::get('/chat', [BotmanController::class, 'chat']);


Route::get('/payment/success', 'DichVuController@success')->name('payment.success');
Route::get('/payment/cancel', 'DichVuController@cancel')->name('payment.cancel');

Route::get('/qr', [QRController::class,'generate']);