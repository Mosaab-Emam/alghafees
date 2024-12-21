<?php

use App\Http\Controllers\API\CategoryAPIController;
use App\Http\Controllers\API\RateRequestAPIController;
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

Route::group(['namespace' => 'App\\Http\\Controllers\\API', 'as' => 'api.'], function () {
    Route::apiResource('rate-requests', RateRequestAPIController::class);
    // Route::get('/tracking', 'RateRequestsController@tracking');
    Route::get('categories/goals', [CategoryAPIController::class, 'goals'])->name('categories.goals');
    Route::get('categories/types', [CategoryAPIController::class, 'types'])->name('categories.types');
    Route::get('categories/entities', [CategoryAPIController::class, 'entities'])->name('categories.entities');
    Route::get('categories/usages', [CategoryAPIController::class, 'usages'])->name('categories.usages');
});

Route::group(['namespace' => 'App\\Http\\Controllers\\Api'], function () {

    Route::get('/about', 'AboutController@index');
    Route::get('/clients', 'ContentController@clients');
    Route::get('/services', 'ContentController@services');
    Route::get('/Prviacy-ploice', 'ContentController@privacy');
    Route::get('/show', 'ContentController@show');
    Route::get('/setting', 'ContentController@contactUs');




    Route::get('/company-services', 'ContentController@companyServices');
    Route::get('/company-services/{id}', 'ContentController@companies');
    Route::get('/counters', 'ContentController@counters');
    Route::get('/objectives', 'ContentController@objectives');
    Route::get('/about-company', 'ContentController@about');


    Route::get('/apartment-goal', 'CategoriesController@apartmentGoal');
    Route::get('/apartment-type', 'CategoriesController@apartmentType');
    Route::get('/apartment-entity', 'CategoriesController@apartmentEntity');
    Route::get('/apartment-usage', 'CategoriesController@apartmentUsage');

});
