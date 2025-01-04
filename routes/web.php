<?php

use App\Helpers\MYPDF;
use Filament\Pages\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Artisan;
use setasign\Fpdi\Tcpdf\Fpdi;
use \App\Http\Controllers;
use App\Http\Controllers\Website\HomeController;
use App\Models\Category;
use App\Models\File;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');

    return "Cache cleared successfully";
});
Route::get('/public/{extra}', function ($extra) {
    return redirect('/' . $extra);
})
    ->where('extra', '.*');

Route::group(['namespace' => 'App\\Http\\Controllers\\Website', 'as' => 'website.', 'prefix' => 'legacy'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/rate-request', 'RateRequestsController@show')->name('rate-request.show');
    Route::post('/rate-request', 'RateRequestsController@store')->name('rate-request.store');
    Route::get('/contactUs', 'HomeController@contactUs')->name('contactUs');
    Route::get('/Prviacy-ploice', 'HomeController@Prviacyploice')->name('Prviacy-ploice');
    Route::get('/tracking', 'RateRequestsController@tracking')->name('tracking');
    Route::get('/tracking_number', 'RateRequestsController@tracking_request_no')->name('tracking_number');
    Route::get('sign/{token}', [Controllers\Admin\ContractController::class, 'signaturePad']);
    Route::post('sign/{token}', [Controllers\Admin\ContractController::class, 'sign']);
    Route::get('download-contract/{token}', [Controllers\Admin\ContractController::class, 'downloadContract'])->name('download-contract');
});

Route::get('/commands', function () {
    \Artisan::call('optimize');
    // \Artisan::call('storage:link');
    return \Artisan::call('db:seed --class=MainPermissionsTableDataSeeder --force');
    // return Artisan::call('migrate', ["--force" => true ]);
});

Route::get('/', function () {
    $report = File::reports()->first();

    return Inertia::render('home/Home', [
        'report' => $report
    ]);
});

Route::get('/about-us', function () {
    $reports = File::reports()->get();
    $evaluations = File::evaluations()->get();

    return Inertia::render('aboutUs/AboutUs', [
        'reports' => $reports,
        'evaluations' => $evaluations
    ]);
});

Route::get('/our-services', function () {
    return Inertia::render('ourServices/OurServices');
});

Route::get('/our-services/{serviceId}', function () {
    return Inertia::render('ourServices/Service', [
        'params' => [
            'serviceId' => request()->serviceId
        ]
    ]);
});

Route::get('/our-clients', function () {
    return Inertia::render('ourClients/OurClients');
});

Route::get('/events', function () {
    return Inertia::render('events/Events');
});

Route::get('/events/{eventId}', function () {
    return Inertia::render('nestedPages/eventDetailsPage/EventDetailsPage');
});

Route::get('/blog', function () {
    return Inertia::render('blog/Blog');
});

Route::get('/blog/{blogId}', function () {
    return Inertia::render('nestedPages/blogDetailsPage/BlogDetailsPage', [
        'params' => [
            'blogId' => request()->blogId
        ]
    ]);
});

Route::get('/contact-us', function () {
    return Inertia::render('contactUs/ContactUs');
});

Route::get('/track-your-request', function () {
    return Inertia::render('trackYourRequest/TrackYourRequest');
});

Route::get('/join-us', function () {
    return Inertia::render('joinUs/JoinUs');
});

Route::get('/privacy-policy', function () {
    return Inertia::render('privacyPolicy/PrivacyPolicy');
});

Route::get('/request-evaluation', function () {
    $post_endpoints = config('app.url') . '/api/rate-requests';
    $goals = Category::apartmentGoal()->get();
    $types = Category::apartmentType()->get();
    $entities = Category::apartmentEntity()->get();
    $usage = Category::apartmentUsage()->get();

    return Inertia::render('requestEvaluation/RequestEvaluation', [
        'post_endpoint' => $post_endpoints,
        'goals' => $goals,
        'types' => $types,
        'entities' => $entities,
        'usage' => $usage,
    ]);
});

Route::fallback(function () {
    return Inertia::render('notFoundPage/NotFoundPage');
});
