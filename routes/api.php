<?php

use App\Http\Controllers\API\CategoryAPIController;
use App\Http\Controllers\API\RateRequestAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// V1 API Controllers
use App\Http\Controllers\API\V1\HomeController;
use App\Http\Controllers\API\V1\AboutUsController;
use App\Http\Controllers\API\V1\ServicesController;
use App\Http\Controllers\API\V1\EventsController;
use App\Http\Controllers\API\V1\BlogController;
use App\Http\Controllers\API\V1\PricingController;
use App\Http\Controllers\API\V1\ReviewsController;
use App\Http\Controllers\API\V1\TrainingController;
use App\Http\Controllers\API\V1\StaticContentController;
use App\Http\Controllers\API\V1\RateRequestController;
use App\Http\Controllers\API\V1\CategoriesController;

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

/*
|--------------------------------------------------------------------------
| V1 API Routes (New Mobile App API)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function () {
    // Home
    Route::get('/home', [HomeController::class, 'index']);
    
    // About Us
    Route::get('/about-us', [AboutUsController::class, 'index']);
    
    // Services
    Route::get('/services', [ServicesController::class, 'index']);
    Route::get('/services/list', [ServicesController::class, 'list']);
    Route::get('/services/{id}', [ServicesController::class, 'show']);
    
    // Events
    Route::get('/events', [EventsController::class, 'index']);
    Route::get('/events/{id}', [EventsController::class, 'show']);
    
    // Blog
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/tags', [BlogController::class, 'tags']);
    Route::get('/blog/{slug}', [BlogController::class, 'show']);
    
    // Pricing
    Route::get('/pricing', [PricingController::class, 'index']);
    
    // Reviews
    Route::get('/reviews', [ReviewsController::class, 'index']);
    Route::post('/reviews', [ReviewsController::class, 'store']);
    Route::get('/reviews/check/{token}', [ReviewsController::class, 'checkToken']);
    
    // Training
    Route::get('/training', [TrainingController::class, 'index']);
    Route::post('/training/apply', [TrainingController::class, 'store']);
    
    // Static Content Pages
    Route::get('/contact-us', [StaticContentController::class, 'contactUs']);
    Route::get('/track-your-request', [StaticContentController::class, 'trackYourRequest']);
    Route::get('/faq', [StaticContentController::class, 'faq']);
    Route::get('/privacy-policy', [StaticContentController::class, 'privacyPolicy']);
    Route::get('/our-clients', [StaticContentController::class, 'ourClients']);
    
    // Rate Requests
    Route::get('/rate-requests/form-data', [RateRequestController::class, 'formData']);
    Route::post('/rate-requests', [RateRequestController::class, 'store']);
    Route::get('/rate-requests/track', [RateRequestController::class, 'track']);
    
    // Categories
    Route::get('/categories/goals', [CategoriesController::class, 'goals']);
    Route::get('/categories/types', [CategoriesController::class, 'types']);
    Route::get('/categories/entities', [CategoriesController::class, 'entities']);
    Route::get('/categories/usages', [CategoriesController::class, 'usages']);
});

/*
|--------------------------------------------------------------------------
| Legacy API Routes (Keep for backward compatibility)
|--------------------------------------------------------------------------
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
