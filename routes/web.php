<?php

use App\Http\Controllers\Front\CertificateController;
use App\Http\Controllers\Front\MarketplaceController;
use App\Http\Controllers\Front\SiteController;
use App\Http\Controllers\Front\UserController as FrontUserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Panel\About\AboutController;
use App\Http\Controllers\Panel\Area\AreaProjectsController;
use App\Http\Controllers\Panel\Area\PAreaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\CompanyController;
use App\Http\Controllers\Panel\ProjectController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\Guest\GuestController;
use App\Http\Controllers\Panel\Inno\EventMemberController;
use App\Http\Controllers\Panel\Inno\LiveController;
use App\Http\Controllers\Panel\Inno\ScheduleController;
use App\Http\Controllers\Panel\Inno\SpeakerController;
use App\Http\Controllers\Panel\News\GalleryController;
use App\Http\Controllers\Panel\News\NewsCategoryController;
use App\Http\Controllers\Panel\News\NewsController;
use App\Http\Controllers\Panel\ProjectCatController;
use App\Http\Controllers\Panel\ProjectTypeController;
use App\Http\Controllers\Panel\UserDeptController;

Route::get('/locale/{locale}', function (string $locale) {
    if (!in_array($locale, ['uz', 'ru', 'en'])) {
        abort(400);
    }
    \Session::put('locale', $locale);
    \App::setLocale($locale);
    //dd(\App::getLocale());
    return redirect()->back();
})->name('change.locale');

Route::group(['prefix' => 'cp', 'middleware' => ['auth:sanctum']], function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('admin.home');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users/all', 'index')->name('admin.users.index');
        Route::get('/users/info', 'UserInfo')->name('admin.users.info');
        Route::post('/users/store', 'storeData')->name('admin.users.store');
        Route::get('/users/destroy', 'destroyData')->name('admin.users.destroy');
    });

    Route::controller(UserDeptController::class)->group(function () {
        Route::get('/users/department/all', 'index')->name('admin.ud.index');
        Route::get('/users/department/info', 'DataInfo')->name('admin.ud.info');
        Route::post('/users/department/store', 'storeData')->name('admin.ud.store');
        Route::get('/users/department/destroy', 'destroyData')->name('admin.ud.destroy');
    });

    Route::controller(ProjectCatController::class)->group(function () {
        Route::get('/projects/categories/all', 'index')->name('admin.pc.index');
        Route::get('/projects/categories/info', 'DataInfo')->name('admin.pc.info');
        Route::post('/projects/categories/store', 'storeData')->name('admin.pc.store');
        Route::get('/projects/categories/destroy', 'destroyData')->name('admin.pc.destroy');
    });

    Route::controller(ProjectTypeController::class)->group(function () {
        Route::get('/projects/pt/all', 'index')->name('admin.pt.index');
        Route::get('/projects/pt/info', 'TypeInfo')->name('admin.pt.info');
        Route::post('/projects/pt/store', 'storeData')->name('admin.pt.store');
        Route::get('/projects/pt/destroy', 'destroyData')->name('admin.pt.destroy');
    });

    Route::controller(CompanyController::class)->group(function () {
        Route::get('/companies/all', 'index')->name('admin.companies.index');
        Route::get('/companies/info', 'CompanyInfo')->name('admin.companies.info');
        Route::post('/companies/store', 'storeData')->name('admin.companies.store');
        Route::get('/companies/destroy', 'destroyData')->name('admin.companies.destroy');
    });

    Route::controller(ProjectController::class)->group(function () {
        Route::get('/projects/all', 'index')->name('admin.projects.index');
        Route::get('/projects/info', 'ProjectInfo')->name('admin.projects.info');
        Route::post('/projects/store', 'storeProjectData')->name('admin.projects.store');
        Route::get('/projects/status/change', 'changeProjectStatus')->name('admin.projects.status');
        Route::get('/projects/destroy', 'destroyData')->name('admin.projects.destroy');

        Route::get('/projects/json/destroy', 'destroyProjectImageData')->name('json.pg.destroy');

    });

    Route::controller(PAreaController::class)->group(function () {
        Route::get('/area/all', 'index')->name('admin.pa.index');
        Route::get('/area/info', 'DataInfo')->name('admin.pa.info');
        Route::post('/area/store', 'storeData')->name('admin.pa.store');
        Route::get('/area/destroy', 'destroyData')->name('admin.pa.destroy');
    });

    Route::controller(AreaProjectsController::class)->group(function () {
        Route::get('/area/projects/all', 'index')->name('admin.ap.index');
        Route::get('/area/projects/info', 'DataInfo')->name('admin.ap.info');
        Route::post('/area/projects/store', 'storeData')->name('admin.ap.store');
    });

    Route::controller(AboutController::class)->group(function () {
        Route::get('/about/all', 'index')->name('admin.about.index');
        Route::get('/about/info', 'DataInfo')->name('admin.about.info');
        Route::post('/about/store', 'storeData')->name('admin.about.store');
        Route::get('/about/destroy', 'destroyData')->name('admin.about.destroy');
        Route::post('/about/files/upload', 'uploadImage')->name('admin.about.io');
    });

    Route::controller(\App\Http\Controllers\Panel\StatisticController::class)->group(function () {
        Route::get('/statistic/all', 'index')->name('admin.statistic.index');
        Route::get('/statistic/info', 'DataInfo')->name('admin.statistic.info');
        Route::post('/statistic/store', 'storeData')->name('admin.statistic.store');
        Route::get('/statistic/destroy', 'destroyData')->name('admin.statistic.destroy');
    });

    //News
    Route::controller(NewsCategoryController::class)->group(function () {
        Route::get('/news/categories/all', 'index')->name('admin.nc.index');
        Route::get('/news/categories/info', 'DataInfo')->name('admin.nc.info');
        Route::post('/news/categories/store', 'storeData')->name('admin.nc.store');
        Route::get('/news/categories/destroy', 'destroyData')->name('admin.nc.destroy');
    });

    Route::controller(NewsController::class)->group(function () {
        Route::get('/news/all', 'index')->name('admin.news.index');
        Route::get('/news/info', 'DataInfo')->name('admin.news.info');
        Route::post('/news/store', 'storeData')->name('admin.news.store');
        Route::get('/news/destroy', 'destroyData')->name('admin.news.destroy');
        Route::post('/news/files/upload', 'uploadImage')->name('admin.news.io');
    });

    Route::controller(GalleryController::class)->group(function () {
        Route::get('/gallery/all', 'index')->name('admin.gallery.index');
        Route::get('/gallery/info', 'DataInfo')->name('admin.gallery.info');
        Route::post('/gallery/store', 'storeData')->name('admin.gallery.store');
        Route::get('/gallery/destroy', 'destroyData')->name('admin.gallery.destroy');
        Route::post('/gallery/files/upload', 'uploadImage')->name('admin.gallery.io');

        Route::post('/gallery/image/store', 'storeGalleryImage')->name('admin.gi.store');
        Route::post('/gallery/archive/store', 'storeDataArchive')->name('admin.archive.store');

        Route::get('/gallery/json/image/destroy', 'destroyGalleryImageData')->name('json.gi.destroy');

    });


    Route::controller(GuestController::class)->group(function () {
        Route::get('/guests/all', 'index')->name('admin.guests.index');
        Route::get('/guests/checkers', 'indexCheckers')->name('admin.guests.checkers');
        Route::get('/guests/info', 'DataInfo')->name('admin.guests.info');
        Route::post('/guests/store', 'storeData')->name('admin.guests.store');
        Route::get('/guests/destroy', 'destroyData')->name('admin.guests.destroy');
    });

    Route::controller(SpeakerController::class)->group(function () {
        Route::get('/speakers/all', 'index')->name('admin.speakers.index');
        Route::get('/speakers/info', 'DataInfo')->name('admin.speakers.info');
        Route::post('/speakers/store', 'storeData')->name('admin.speakers.store');
        Route::get('/speakers/destroy', 'destroyData')->name('admin.speakers.destroy');
    });

    Route::controller(ScheduleController::class)->group(function () {
        Route::get('/schedules/all', 'index')->name('admin.schedules.index');
        Route::get('/schedules/info', 'DataInfo')->name('admin.schedules.info');
        Route::post('/schedules/store', 'storeData')->name('admin.schedules.store');
        Route::get('/schedules/destroy', 'destroyData')->name('admin.schedules.destroy');
    });

    Route::controller(EventMemberController::class)->group(function () {
        Route::get('/events/all', 'index')->name('admin.events.members');
    });

    Route::controller(LiveController::class)->group(function () {
        Route::get('/live/all', 'index')->name('admin.live.index');
        Route::get('/live/info', 'DataInfo')->name('admin.live.info');
        Route::post('/live/store', 'storeData')->name('admin.live.store');
        Route::get('/live/destroy', 'destroyData')->name('admin.live.destroy');
    });

    // Route::controller(OfferController::class)->group(function () {
    //     Route::get('/offer/all', 'index')->name('admin.offers.index');
    // });

});


Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index')->name('front.home');
    Route::get('/online/registration', 'index')->name('front.online.registration');
    Route::get('/about', 'about')->name('front.menu.about');
    Route::get('/certificates', 'certificate')->name('front.certificates.index');
    Route::get('/news', 'news')->name('front.menu.news');
    Route::get('/news/{id}', 'newsShow')->name('front.news.detail');
    Route::get('/speakers', 'speakers')->name('front.speakers.index');
    Route::get('/live/online', 'live')->name('front.live.online');

    Route::get('/competition/fest', 'YoungFest')->name('front.competition.fest');

});

Route::controller(CertificateController::class)->group(function () {
    //Route::get('/cerf/checker', 'getCerf')->name('d-checker-cerf');
    Route::post('/cerf/check/user', 'checkUserCertificate')->name('front.certificate.check');
});

Route::controller(MarketplaceController::class)->group(function () {
    Route::get('/marketplace', 'index')->name('front.marketplace.index');
    Route::get('/marketplace/list/{type_id}', 'indexByTypeID')->name('front.marketplace.projectTypeList');
    Route::get('/marketplace/info/{id}', 'projectShow')->name('front.marketplace.projectInfo');
});

//Member registration and profiel
Route::controller(FrontUserController::class)->group(function () {
    Route::post('/members/register/validate', 'validateUserData')->name('front.members.validate');
    Route::post('/members/register/store', 'registerMember')->name('front.members.register');
    Route::get('/members/get/ticket', 'DataInfo')->name('front.members.getTicket');
    Route::post('/members/check/ticket', 'checkUserTicket')->name('front.members.checkTicket');

    Route::post('/members/event/store', 'storeEventMember')->name('front.members.eventStore');

});

// Email verification routes
//Route::get('/email/verify', function () {
//    return view('auth.verify-email');
//})->middleware('auth')->name('verification.notice');
//
//Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//    $request->fulfill();
//    return redirect('/');
//})->middleware(['auth', 'signed'])->name('verification.verify');
//
//Route::post('/email/verification-notification', function (Request $request) {
//    $request->user()->sendEmailVerificationNotification();
//    return back()->with('message', 'Verification link sent!');
//})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/h', function () {
    return redirect()->route('admin.home');
    //return view('welcome');
});

//JSON Data
Route::controller(IndexController::class)->group(function () {
    Route::get('/get/json/regions', 'getRegionsByCountryIdJSON')->name('json.get.regions');
    Route::get('/get/json/districts', 'getDistrictByRegionIdJSON')->name('json.get.districts');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
