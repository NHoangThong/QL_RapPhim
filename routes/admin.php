<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoaiPhimController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\LichTrinhController;
use App\Http\Controllers\DichVuController;
use App\Http\Controllers\HomeAdminController;
 

use App\Http\Controllers\BannerController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\DaoDienController;
use App\Http\Controllers\DienVienController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\GiaVeController;
use App\Http\Controllers\PhongContronller;
use App\Http\Controllers\RapPhimController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TinTucController;
use App\Models\Phong;
use App\Http\Controllers\VeController;
Route::post('/savestatus', [LoaiPhimController::class, 'saveStatus'])->name('save-status');
Route::post('/savestatus', [PhimController::class, 'saveStatus'])->name('save-status');

Route::get('/admin/sign_in', [AdminController::class, 'sign_in']);
Route::post('/admin/sign_in', [AdminController::class, 'Post_sign_in']);
Route::get('/admin/sign_out', [AdminController::class, 'sign_out']);

Route::middleware(['admin'])->group(function() {
Route::prefix('admin')->group(function () {
    
    Route::get('/', [AdminController::class, 'home']);

    Route::get('/', [HomeAdminController::class, 'home']);
    Route::get('/filter-by-date', [HomeAdminController::class, 'filter_by_date']);
    Route::get('/statistical-filter', [HomeAdminController::class, 'statistical_filter']);
    Route::get('/statistical-sortby', [HomeAdminController::class, 'statistical_sortby']);
    //Revenue
    // Route::get('/search_movie', [AdminController::class, 'search_movie']);
    // Route::get('/search_theater', [AdminController::class, 'search_theater']);
    // // statistical
    // Route::get('/filter-by-date', [AdminController::class, 'filter_by_date']);
    // Route::get('/statistical-filter', [AdminController::class, 'statistical_filter']);
    // Route::get('/statistical-sortby', [AdminController::class, 'statistical_sortby']);

    // // scan ticket
    // Route::prefix('scanTicket')->group(function () {
    //     Route::post('/handle', [StaffController::class, 'handleScanTicket']);
    //     Route::get('/', [StaffController::class, 'scanTicket']);
    // });
    Route::prefix('banve')->group(function () {
        Route::post('/handleResult', [StaffController::class, 'handleResult']);
        Route::post('/createPayment', [StaffController::class, 'createPayment']);
        Route::post('/ticketPayment', [StaffController::class, 'ticketPayment']);
        Route::post('/scanBC', [StaffController::class, 'scanBarcode']);
        Route::get('/{schedule_id}', [StaffController::class, 've']);
        Route::get('/', [StaffController::class, 'banve']);
        Route::post('/tao_ve', [StaffController::class, 'tao_ve']);
        Route::delete('/xoave', [StaffController::class, 'xoave']);
        Route::post('/taovecombo', [StaffController::class, 'taovecombo']);

     
    });

    Route::prefix('loaiphim')->group(function () {
        Route::get('/', [LoaiPhimController::class, 'loaiPhim']);
        Route::post('/create', [LoaiPhimController::class, 'postCreate']);
        Route::post('/edit/{id}', [LoaiPhimController::class, 'postEdit']);
        Route::post('/delete/{id}', [LoaiPhimController::class, 'delete']);

        
    });

    Route::prefix('phim')->group(function () {
        Route::get('/', [PhimController::class, 'phim']);
        Route::get('/create', [PhimController::class, 'getCreate']);
        Route::post('/create', [PhimController::class, 'postCreate']);
        Route::get('/edit/{id}', [PhimController::class, 'getEdit']);
        Route::post('/edit/{id}', [PhimController::class, 'postEdit']);

        // Route::post('/delete/{id}', [LoaiPhimController::class, 'delete']);

        
    });
    Route::prefix('lichtrinh')->group(function () {
        Route::get('/', [LichTrinhController::class, 'lichtrinh']);
        // Route::get('/create', [PhimController::class, 'getCreate']);
        Route::post('/create', [LichTrinhController::class, 'create']);
        // Route::get('/edit/{id}', [PhimController::class, 'getEdit']);
        // Route::post('/edit/{id}', [PhimController::class, 'postEdit']);

        // Route::post('/delete/{id}', [LoaiPhimController::class, 'delete']);
        Route::get('/status', [LichTrinhController::class, 'status']);
        Route::get('/early_status',[LichTrinhController::class,'early_status']);
        Route::post('/deleteAll', [LichTrinhController::class,'deleteAll']);
        Route::post('/xoaItem/{id}', [LichTrinhController::class,'xoaItem']);

    });

    Route::delete('/tickets/delete', [DichVuController::class, 'deleteVe']);
    Route::prefix('buyTicket')->group(function () {
        Route::post('/handleResult', [DichVuController::class, 'handleResult']);
        Route::post('/createPayment', [DichVuController::class, 'createPayment']);
        Route::post('/ticketPayment', [DichVuController::class, 'ticketPayment']);
        // Route::post('/scanBC', [StaffController::class, 'scanBarcode']);
        // Route::get('/{schedule_id}', [StaffController::class, 'ticket']);
        // Route::get('/', [StaffController::class, 'buyTicket']);
    });
    Route::post('/ticketCombo/create', [DichVuController::class, 'createTicketCombo']);
    Route::prefix('buyCombo')->group(function () {
        Route::get('/', [DichVuController::class, 'buyCombo'])->name('combo');
    });

    Route::prefix('daodien')->group(function(){
        Route::get('/', [DaoDienController::class, 'daoDien']);
        Route::post('/create', [DaoDienController::class, 'postCreate']);
        Route::post('/edit/{id}', [DaoDienController::class, 'postEdit']);
        Route::delete('/delete/{id}', [DaoDienController::class, 'delete']);
    });

    Route::prefix('dienvien')->group(function () {
        Route::get('/', [DienVienController::class, 'dienVien']);
        Route::post('/create', [DienVienController::class, 'postCreate']);
        Route::post('/edit/{id}', [DienVienController::class, 'postEdit']);
        Route::delete('/delete/{id}', [DienVienController::class, 'delete']);
    });

    //gia ve
    Route::prefix('gia_ve')->group(function () {
        Route::get('/', [GiaVeController::class, 'price']);
        Route::post('/edit', [GiaVeController::class, 'edit']);
    });


     //Food
     Route::prefix('food')->group(function () {
        Route::get('/', [FoodController::class, 'food']);
        Route::post('/create', [FoodController::class, 'postCreate']);
        Route::post('/edit/{id}', [FoodController::class, 'postEdit']);
        Route::delete('/delete/{id}', [FoodController::class, 'delete']);
        Route::get('/status', [FoodController::class, 'status']);
        Route::post('/change-status', [FoodController::class, 'status'])->name('changeStatusFood');
    });


    //rap

    Route::prefix('rap')->group(function () {
        Route::get('/', [RapPhimController::class, 'theater']);
        Route::post('/create', [RapPhimController::class, 'postCreate']);
        Route::post('/edit/{id}', [RapPhimController::class, 'postEdit']);
        Route::get('/status', [RapPhimController::class, 'status']);
        Route::post('/change-status', [RapPhimController::class, 'status'])->name('changeStatusRap');
        Route::delete('/delete/{id}', [RapPhimController::class, 'delete']);
    });


    //phong

    Route::prefix('phong')->group(function () {
        Route::get('/list/{id}', [PhongContronller::class, 'room']);
        Route::delete('/delete/{id}', [PhongContronller::class, 'delete']);
        Route::post('/create', [PhongContronller::class, 'postCreate']);
        Route::post('/edit/{id}', [PhongContronller::class, 'postEdit']);
        Route::get('/status', [PhongContronller::class, 'status']);
        Route::post('/change-status', [PhongContronller::class, 'status'])->name('changeStatusPhong');
    });


    //Combo
    Route::prefix('combo')->group(function () {
        Route::get('/', [ComboController::class, 'combo']);
        Route::post('/create', [ComboController::class, 'postCreate']);
        Route::post('/change-status', [ComboController::class, 'status'])->name('changeStatusCombo');
        Route::post('/edit/{id}', [ComboController::class, 'postEdit']);
        
        Route::delete('/delete/{id}', [ComboController::class, 'delete']);
    });


    //banners
    Route::prefix('banner')->group(function () {
        Route::get('/', [BannerController::class, 'banners']);
        Route::post('/create', [BannerController::class, 'postCreate']);
        Route::post('/edit/{id}', [BannerController::class, 'postEdit']);
        Route::delete('/delete/{id}', [BannerController::class, 'delete']);
       
        Route::post('/change-status', [BannerController::class, 'status'])->name('changeStatusBanner');
    });
    //TODO tin tuc
    Route::prefix('tintuc')->group(function () {
        Route::get('/', [TinTucController::class, 'news']);
        Route::post('/create', [TinTucController::class, 'postCreate']);
        Route::post('/edit/{id}', [TinTucController::class, 'postEdit']);
        Route::delete('/delete/{id}', [TinTucController::class, 'delete']);
        Route::post('/change-status', [TinTucController::class, 'status'])->name('changeStatusNews');
    });
    Route::prefix('ve')->group(function () {
        Route::get('/', [VeController::class, 'ticket']);
    });
});


});