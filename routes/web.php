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

Route::get('/request-evaluation', function () {
    $goals = Category::apartmentGoal()->get();
    $types = Category::apartmentType()->get();
    $entities = Category::apartmentEntity()->get();
    $usage = Category::apartmentUsage()->get();

    return Inertia::render('requestEvaluation/RequestEvaluation', [
        'goals' => $goals,
        'types' => $types,
        'entities' => $entities,
        'usage' => $usage,
    ]);
});

Route::fallback(function () {
    $reports = File::reports()->get();
    $evaluations = File::evaluations()->get();

    $home_report = $reports->first();

    $goals = Category::apartmentGoal()->get();
    $types = Category::apartmentType()->get();
    $entities = Category::apartmentEntity()->get();
    $usage = Category::apartmentUsage()->get();

    return Inertia::render('layout/Layout', props: [
        'reports' => $reports,
        'evaluations' => $evaluations,
        'home_report' => $home_report,
        'goals' => $goals,
        'types' => $types,
        'entities' => $entities,
        'usage' => $usage,
    ]);
});
