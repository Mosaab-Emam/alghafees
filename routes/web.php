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
use App\Models\Event;
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

Route::get('/sign/{token}', [Controllers\Admin\ContractController::class, 'signaturePad']);
Route::post('/sign/{token}', [Controllers\Admin\ContractController::class, 'sign']);

Route::get('/', function () {
    $report = File::reports()->first();
    $events = Event::orderBy('id', 'desc')->take(2)->get();

    return Inertia::render('home/Home', [
        'report' => $report,
        'events' => $events
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
    $events = Event::all();
    return Inertia::render('events/Events', [
        'events' => $events
    ]);
});

Route::get('/events/{event}', function (Event $event) {
    return Inertia::render('nestedPages/eventDetailsPage/EventDetailsPage', [
        'event' => $event
    ]);
});

Route::get('/blog', function () {
    $posts = \LaraZeus\Sky\Models\Post::with([
        'author' => function ($query) {
            $query->select('id', 'name', 'image');
        }
    ])->orderBy('published_at', 'desc')->get();

    return Inertia::render('blog/Blog', [
        'posts' => $posts
    ]);
});

Route::get('/blog/{id}', function ($id) {
    $post = \LaraZeus\Sky\Models\Post::with(['author' => fn($q) => $q->select('id', 'name', 'image')])
        ->find($id);


    // Remove default styles
    $post->content = preg_replace(
        '/style=".*?"/',
        '',
        $post->parseContent($post->content)
    );

    // Add tailwind classes to paragraphs
    $post->content = preg_replace(
        '/\<p\s?/',
        '<p class="regular-b1 text-Gray-scale-02 text-right mb-4" ',
        $post->parseContent($post->content)
    );

    // Add tailwind classes to h3 tags
    $post->content = preg_replace(
        '/\<h3\s?/',
        '<h3 class="head-line-h5 mt-8 mb-4" ',
        $post->parseContent($post->content)
    );

    // Add tailwind classes to h4 tags
    $post->content = preg_replace(
        '/\<h4\s?/',
        '<h4 class="head-line-h6 mb-2" ',
        $post->parseContent($post->content)
    );

    // Replace custom button tags
    $post->content = preg_replace(
        '/\$discount30/',
        '<a target="_blank" href="https://api.whatsapp.com/send?phone=966539455519&text=%D8%B4%D8%A7%D9%87%D8%AF%D8%AA%20%D9%85%D9%88%D9%82%D8%B9%D9%83%D9%85%20%D8%A7%D9%84%D8%A5%D9%84%D9%83%D8%AA%D8%B1%D9%88%D9%86%D9%8A%20%D9%88%20%D8%A3%D8%A8%D9%8A%20%20%D8%AA%D9%82%D9%8A%D9%8A%D9%85%20%D8%B9%D9%82%D8%A7%D8%B1%D9%8A"><button type="button" class="btn btn-ltr-radius btn-primary xl:w-[364px] lg:w-[320px] w-full sm:h-[48px] lg:h-[46px] xl:h-[48px] py-[15px] px-[80px ">احصل على خصم 30%</button></a>',
        $post->parseContent($post->content)
    );
    $post->content = preg_replace(
        '/\$evaluation/',
        '<a target="_blank" href="https://api.whatsapp.com/send?phone=966539455519&text=%D8%B4%D8%A7%D9%87%D8%AF%D8%AA%20%D9%85%D9%88%D9%82%D8%B9%D9%83%D9%85%20%D8%A7%D9%84%D8%A5%D9%84%D9%83%D8%AA%D8%B1%D9%88%D9%86%D9%8A%20%D9%88%20%D8%A3%D8%A8%D9%8A%20%20%D8%AA%D9%82%D9%8A%D9%8A%D9%85%20%D8%B9%D9%82%D8%A7%D8%B1%D9%8A"><button type="button" class="btn btn-ltr-radius btn-primary xl:w-[364px] lg:w-[320px] w-full sm:h-[48px] lg:h-[46px] xl:h-[48px] py-[15px] px-[80px ">اطلب تقييمك من خبير</button></a>',
        $post->parseContent($post->content)
    );
    $post->content = preg_replace(
        '/\$price/',
        '<a target="_blank" href="https://api.whatsapp.com/send?phone=966539455519&text=%D8%B4%D8%A7%D9%87%D8%AF%D8%AA%20%D9%85%D9%88%D9%82%D8%B9%D9%83%D9%85%20%D8%A7%D9%84%D8%A5%D9%84%D9%83%D8%AA%D8%B1%D9%88%D9%86%D9%8A%20%D9%88%20%D8%A3%D8%A8%D9%8A%20%20%D8%AA%D9%82%D9%8A%D9%8A%D9%85%20%D8%B9%D9%82%D8%A7%D8%B1%D9%8A"><button type="button" class="btn btn-ltr-radius btn-primary xl:w-[364px] lg:w-[320px] w-full sm:h-[48px] lg:h-[46px] xl:h-[48px] py-[15px] px-[80px ">اطلب عرض سعر تقييم</button></a>',
        $post->parseContent($post->content)
    );

    $latest_posts = \LaraZeus\Sky\Models\Post::orderBy('published_at', 'desc')
        ->with(['author' => fn($q) => $q->select('id', 'name', 'image')])
        ->where('id', '!=', $post->id)
        ->limit(2)
        ->get();

    $related_posts = \LaraZeus\Sky\Models\Post::withAnyTagsOfAnyType($post->tags)
        ->with(['author' => fn($q) => $q->select('id', 'name', 'image')])
        ->where('id', '!=', $post->id)
        ->get();

    return Inertia::render('nestedPages/blogDetailsPage/BlogDetailsPage', [
        'post' => $post,
        'latest_posts' => $latest_posts,
        'related_posts' => $related_posts
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
