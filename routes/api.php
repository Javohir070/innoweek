<?php

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\PrintController;
use App\Http\Controllers\API\v1\AboutApiController;
use App\Http\Controllers\API\v1\AuthApiController;
use App\Http\Controllers\API\v1\MarketplaceAPIController;
use App\Http\Controllers\API\v1\NewsApiController;
use App\Http\Controllers\APi\v1\OfferApiController;
use App\Http\Controllers\API\v1\SpeakersAPIController;
use App\Http\Controllers\API\v1\UserApiController;
use App\Http\Controllers\Front\CertificateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/check/ticket', [ApiController::class, 'checkTicket'])->name('api-ticket-checker');//api chipta tekshirish
Route::post('/check/approve', [ApiController::class, 'approveTicket'])->name('api-ticket-approve');//api chipta tasdiqlash
Route::post('/checker/login', [ApiController::class, 'loginChecker']);//api chipta login tekshirish
Route::post('/checker/info', [ApiController::class, 'GetUserInfo']);//api chipta info tekshirish
Route::post('/user/check/ticket', [ApiController::class, 'checkUserTicket']);
Route::get('/members/get/ticket', [ApiController::class, 'getMemberTicket']);


Route::controller(PrintController::class)->group(function () {
    Route::post('/register', 'register');
});

//, 'middleware' => ['auth:sanctum']]
Route::group(['prefix' => 'v1.0'], function () {

    Route::controller(AuthApiController::class)->group(function () {
        Route::post('/register/validate', 'validateUserData');
        Route::post('/register/complete', 'register');

        Route::post('/login/validate', 'loginValidate');
        Route::post('/login/complete', 'login');

        Route::post('/user/login', 'loginUser');
        Route::post('/user/verify', 'verifyUser');
        Route::post('/forgot-password', 'forgotPassword');

        Route::get('/json/countries', 'GetCountryList');
        Route::get('/json/profession', 'GetProfessionsList');
    });

    Route::controller(UserApiController::class)->group(function () {
        Route::post('/user/me', 'GetUserInfo');
        Route::post('/user/change-password', 'ChangePassword');
        Route::post('/logout', 'logout');
        Route::post('/user/event/store',  'storeEventMember');

    });

    //News
    Route::controller(NewsApiController::class)->group(function () {
        Route::get('news/all', 'GetAllNews');
        Route::get('news/get/{id}', 'GetByIDNews');
        Route::get('user/get/{DataID}', 'GetByID');
        Route::put('user/update/info', 'UpdateUserInfo');
        Route::put('user/update/password', 'UpdateUserPassword');
        Route::get('user/my/info', 'GetUserInfo');
        Route::put('user/status/{DataID}', 'ChangeStatus');
        Route::put('user/delete/{DataID}', 'RemoveDataByID');

        Route::put('user/update/access/{DataID}', 'setUserAccess');
    });

    Route::controller(AboutApiController::class)->group(function () {
        Route::get('about/info', 'GetAbout');
        Route::get('schedules/days', 'GetSchedulesDays');
        Route::get('schedules/list', 'GetScheduleListByDate');
        Route::get('live/list', 'GetLiveVideos');
        Route::get('gallery/list', 'GetInnoGallery');
        Route::get('gallery/list', 'GetInnoGallery');
        Route::get('profession/list', 'GetProfession');
    });


    Route::controller(CertificateController::class)->group(function () {
        Route::post('/telegram/check/certificate', 'checkUserCertificateTelegram');
    });


    Route::controller(SpeakersAPIController::class)->group(function () {
        Route::get('speakers/all', 'GetAllSpeakers');
    });

    Route::controller(MarketplaceAPIController::class)->group(function () {
        Route::post('marketplace/all', 'GetAllProducts');
        Route::post('marketplace/list/categories', 'GetProjectCategoryList');
    });

    Route::controller(OfferApiController::class)->group(function () {
        Route::post('offer/store', 'storeOffer');
    });

});
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
