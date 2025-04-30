<?php

use Illuminate\Support\Facades\Route;
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
use \App\Http\Controllers;
use App\Http\Controllers\Website\HomeController;
use App\Models\AboutUsStaticContent;
use App\Models\BlogStaticContent;
use App\Models\Category;
use App\Models\ContactUsStaticContent;
use App\Models\Content;
use App\Models\Event;
use App\Models\EventsStaticContent;
use App\Models\File;
use App\Models\HomeStaticContent;
use App\Models\InfoStaticContent;
use App\Models\JoinUsStaticContent;
use App\Models\OurClientsStaticContent;
use App\Models\OurServicesStaticContent;
use App\Models\RequestEvaluationStaticContent;
use App\Models\Review;
use App\Models\TrackYourRequestStaticContent;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;

Route::get(
    '/clear-cache',
    function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');

        return "Cache cleared successfully";
    }
);
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
    Artisan::call('optimize');
    // \Artisan::call('storage:link');
    return Artisan::call('db:seed --class=MainPermissionsTableDataSeeder --force');
    // return Artisan::call('migrate', ["--force" => true ]);
});

Route::get('/sign/{token}', [Controllers\Admin\ContractController::class, 'signaturePad']);
Route::post('/sign/{token}', [Controllers\Admin\ContractController::class, 'sign']);
Route::get('download-contract/{token}', [Controllers\Admin\ContractController::class, 'downloadContract'])->name('download-contract');

Route::get('/', function () {
    $static_content = array_merge(
        HomeStaticContent::first()->toArray(),
        InfoStaticContent::first()->toArray()
    );
    $report = File::reports()->first();
    $events = Event::orderBy('id', 'desc')->take(2)->get();
    $reviews = Review::whereNotNull('name')
        ->whereNotNull('description')
        ->whereNotNull('image')
        ->whereNotNull('rating')
        ->whereNotNull('body')
        ->get();

    return Inertia::render('home/Home', [
        'title' => 'الرئيسية | مقيم عقاري معتمد - شركة صالح علي الغفيص',
        'description' => 'شركة صالح علي الغفيص، مقيم عقاري معتمد بخبرة تفوق 20 عامًا في تقييم العقارات بالرياض والقصيم. نقدم خدمات تقييم دقيقة تتوافق مع المعايير الدولية. الخط الساخن: 0539455519',
        'static_content' => $static_content,
        'report' => $report,
        'events' => $events,
        'reviews' => $reviews
    ]);
});

Route::get('/about-us', function () {
    $static_content = array_merge(
        AboutUsStaticContent::first()->toArray(),
        InfoStaticContent::first()->toArray()
    );
    $reports = File::reports()->get();
    $evaluations = File::evaluations()->get();

    return Inertia::render('aboutUs/AboutUs', [
        'title' => 'من نحن | مقيم عقاري معتمد- شركة صالح علي الغفيص',
        'description' => 'شركة صالح علي الغفيص، مقيم عقاري معتمد بخبرة تفوق 20 عامًا في تقييم العقارات بالرياض والقصيم. نقدم خدمات تقييم دقيقة تتوافق مع المعايير الدولية. الخط الساخن: 0539455519',
        'static_content' => $static_content,
        'reports' => $reports,
        'evaluations' => $evaluations
    ]);
});

Route::get('/our-services', function () {
    $static_content = array_merge(
        OurServicesStaticContent::first()->toArray(),
        InfoStaticContent::first()->toArray()
    );
    return Inertia::render('ourServices/OurServices', [
        'title' => 'خدماتنا | خدمات الغفيص للتقييم العقاري - مقيم عقاري معتمد',
        'description' => 'نقدم خدمات مقيم عقاري معتمد تشمل التقييم العقاري، دراسات الجدوى، دراسات السوق، وأفضل استخدام للعقارات في المملكة. معتمدون من الهيئة السعودية للمقيمين. الخط الساخن: 0539455519',
        'static_content' => $static_content
    ]);
});

Route::get('/our-services/{serviceId}', function () {
    $static_content = InfoStaticContent::first()->toArray();
    $service = Content::find(request()->serviceId);

    return Inertia::render('ourServices/Service', [
        'params' => [
            'serviceId' => $service->id
        ],
        'title' => 'خدماتنا | خدمات الغفيص للتقييم العقاري - مقيم عقاري معتمد',
        'description' => 'نقدم خدمات مقيم عقاري معتمد تشمل التقييم العقاري، دراسات الجدوى، دراسات السوق، وأفضل استخدام للعقارات في المملكة. معتمدون من الهيئة السعودية للمقيمين. الخط الساخن: 0539455519',
        'static_content' => $static_content
    ]);
});

Route::get('/our-clients', function () {
    $static_content = array_merge(
        OurClientsStaticContent::first()->toArray(),
        InfoStaticContent::first()->toArray()
    );
    $reviews = Review::whereNotNull('name')
        ->whereNotNull('description')
        ->whereNotNull('image')
        ->whereNotNull('rating')
        ->whereNotNull('body')
        ->get();

    return Inertia::render('ourClients/OurClients', [
        'title' => 'عملاؤنا | مقيم عقاري موثوق لشركات التطوير والاستثمار - الغفيص للتقييم العقاري',
        'description' => 'نخدم أبرز الشركات العقارية والمستثمرين كـمقيم عقاري موثوق في السعودية، ونقدم تقييمات دقيقة لدعم قرارات الشراء والاستثمار. الخط الساخن: 0539455519',
        'static_content' => $static_content,
        'reviews' => $reviews
    ]);
});

Route::get('/events', function () {
    $static_content = array_merge(
        EventsStaticContent::first()->toArray(),
        InfoStaticContent::first()->toArray()
    );
    $events = Event::all();
    return Inertia::render('events/Events', [
        'title' => 'الفعاليات | مشاركاتنا كـ مقيم عقاري في المؤتمرات والبرامج التدريبية',
        'description' => 'تابع أنشطة شركة صالح علي الغفيص كمقيم عقاري معتمد في السعودية، ومشاركتها في الفعاليات والدورات المهنية لتعزيز قطاع التقييم العقاري. الخط الساخن: 0539455519',
        'static_content' => $static_content,
        'events' => $events
    ]);
});

Route::get('/events/{event}', function (Event $event) {
    $static_content = InfoStaticContent::first()->toArray();
    return Inertia::render('nestedPages/eventDetailsPage/EventDetailsPage', [
        'title' => $event->title . ' | مشاركاتنا كـ مقيم عقاري في المؤتمرات والبرامج التدريبية',
        'description' => 'تابع أنشطة شركة صالح علي الغفيص كمقيم عقاري معتمد في السعودية، ومشاركتها في الفعاليات والدورات المهنية لتعزيز قطاع التقييم العقاري. الخط الساخن: 0539455519',
        'event' => $event,
        'static_content' => $static_content
    ]);
});

Route::get('/request-evaluation', function () {
    $static_content = array_merge(
        RequestEvaluationStaticContent::first()->toArray(),
        InfoStaticContent::first()->toArray()
    );
    $post_endpoints = config('app.url') . '/api/rate-requests';
    $goals = Category::apartmentGoal()->get();
    $types = Category::apartmentType()->get();
    $entities = Category::apartmentEntity()->get();
    $usage = Category::apartmentUsage()->get();

    return Inertia::render('requestEvaluation/RequestEvaluation', [
        'title' => 'طلب تقييم عقاري | مقيم عقاري معتمد - شركة صالح علي الغفيص',
        'description' => 'قدّم طلبك الآن للحصول على تقييم عقاري رسمي من مقيم عقاري معتمد لجميع أنواع الأصول العقارية في المملكة. خدمة موثوقة وسريعة. الخط الساخن: 0539455519',
        'static_content' => $static_content,
        'post_endpoint' => $post_endpoints,
        'goals' => $goals,
        'types' => $types,
        'entities' => $entities,
        'usage' => $usage,
    ]);
})->name("new-request-evaluation");

Route::get('/blog', function () {
    $static_content = array_merge(
        BlogStaticContent::first()->toArray(),
        InfoStaticContent::first()->toArray()
    );
    $search_query = request('search');
    $tag_slug = request('tag'); // Accepting tag as an optional parameter
    $page = request('page', 1);
    $perPage = 9;

    $query = Post::orderBy('published_at', 'desc')
        ->when($search_query, function ($queryBuilder) use ($search_query) {
            return $queryBuilder->where('title', 'like', '%' . $search_query . '%');
        })
        ->when($tag_slug, function ($queryBuilder) use ($tag_slug) {
            return $queryBuilder->whereHas('tags', function ($query) use ($tag_slug) {
                $query->where('slug->ar', $tag_slug);
            });
        });

    $posts = $query->paginate($perPage, ['*'], 'page', $page);

    foreach ($posts as $post) {
        $post->featured_image = $post->image();
    }

    $max_pages = $posts->lastPage();

    $tags = Tag::withCount('postsPublished')
        ->orderBy('posts_published_count', 'desc')
        ->get();

    return Inertia::render('blog/Blog', [
        'title' => 'مدونة مقيم عقاري | تحليلات عقارية ونصائح من خبراء التقييم',
        'description' => 'اقرأ مقالات محدثة من مقيم عقاري محترف عن تقييم العقارات، السوق العقاري، دراسات الجدوى، والفرص الاستثمارية في السعودية. الخط الساخن: 0539455519',
        'static_content' => $static_content,
        'posts' => $posts->getCollection(),
        'max_pages' => $max_pages,
        'tags' => $tags
    ]);
});

Route::get('/blog/{id}', function ($id) {
    $tags = Tag::withCount('postsPublished')->get();
    $post = Post::find($id);
    $static_content = InfoStaticContent::first()->toArray();
    $post->featured_image = $post->image();

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

    // TODO: get to the bottom of this issue
    $post_content = $post->content;

    $latest_posts = Post::orderBy('published_at', 'desc')
        ->where('id', '!=', $post->id)
        ->limit(2)
        ->get();

    $related_posts = Post::withAnyTagsOfAnyType($post->tags)
        ->where('id', '!=', $post->id)
        ->get();

    foreach ($latest_posts as $lp) {
        $lp->featured_image = $post->image();
    }

    foreach ($related_posts as $rp) {
        $rp->featured_image = $rp->image();
    }


    return Inertia::render('nestedPages/blogDetailsPage/BlogDetailsPage', [
        'title' => $post->title . ' | تحليلات عقارية ونصائح من خبراء التقييم',
        'description' => 'اقرأ مقالات محدثة من مقيم عقاري محترف عن تقييم العقارات، السوق العقاري، دراسات الجدوى، والفرص الاستثمارية في السعودية. الخط الساخن: 0539455519',
        'tags' => $tags,
        'post' => $post,
        'main_tag' => $post->tags->first()->name,
        'post_content' => $post_content,
        'latest_posts' => $latest_posts,
        'related_posts' => $related_posts,
        'static_content' => $static_content
    ]);
});

Route::get('/contact-us', function () {
    $static_content = array_merge(
        ContactUsStaticContent::first()->toArray(),
        InfoStaticContent::first()->toArray()
    );
    return Inertia::render('contactUs/ContactUs', [
        'title' => 'تواصل معنا | احجز موعد مع مقيم عقاري معتمد - الغفيص للتقييم',
        'description' => 'تواصل مع مقيم عقاري معتمد من شركة صالح علي الغفيص عبر الهاتف أو البريد لطلب خدمات التقييم العقاري في جميع أنحاء السعودية. الخط الساخن: 0539455519',
        'static_content' => $static_content
    ]);
});

Route::get('/track-your-request', function () {
    $static_content = array_merge(
        TrackYourRequestStaticContent::first()->toArray(),
        InfoStaticContent::first()->toArray()
    );
    return Inertia::render('trackYourRequest/TrackYourRequest', [
        'title' => 'تتبع طلب تقييم عقاري | مقيم عقاري معتمد - شركة صالح علي الغفيص',
        'description' => 'تتبع طلب تقييم عقاري من شركة صالح علي الغفيص للحصول على آخر التحديثات والتقارير العقارية. الخط الساخن: 0539455519',
        'static_content' => $static_content
    ]);
});

Route::get('/join-us', function () {
    $static_content = array_merge(
        JoinUsStaticContent::first()->toArray(),
        InfoStaticContent::first()->toArray()
    );
    return Inertia::render('joinUs/JoinUs', [
        'title' => 'انضم إلى الغفيص للتقييم | مقيم عقاري معتمد - شركة صالح علي الغفيص',
        'description' => 'انضم إلى شركة صالح علي الغفيص كمقيم عقاري معتمد للحصول على أفضل الخدمات العقارية في المملكة. الخط الساخن: 0539455519',
        'static_content' => $static_content
    ]);
});

Route::get('/privacy-policy', function () {
    $static_content = InfoStaticContent::first()->toArray();
    return Inertia::render('privacyPolicy/PrivacyPolicy', [
        'title' => 'سياسة الخصوصية | مقيم عقاري معتمد - شركة صالح علي الغفيص',
        'description' => 'تعرف على سياسة الخصوصية لشركة صالح علي الغفيص للتقييم العقاري في المملكة. الخط الساخن: 0539455519',
        'static_content' => $static_content
    ]);
});

Route::get('/review/{token}', function (string $token) {
    $review = Review::where('token', $token)->first();
    $static_content = InfoStaticContent::first()->toArray();
    if (!$review || $review->is_filled)
        return Inertia::render('notFoundPage/NotFoundPage');

    return Inertia::render('Review', [
        'title' => 'تقييمك للخدمة | مقيم عقاري معتمد - شركة صالح علي الغفيص',
        'description' => 'قدّم تقييمك لشركة صالح علي الغفيص للتقييم العقاري في المملكة. الخط الساخن: 0539455519',
        'review_token' => $review->token,
        'static_content' => $static_content
    ]);
});

Route::post('/review', function () {
    $review = Review::where('token', request()->review_token)->first();
    if (!$review || $review->name != null)
        abort(404);

    $review->update([
        'name' => request()->name,
        'description' => request()->description,
        'image' => request()->file('image')->store('reviews', 'public'),
        'rating' => request()->rating,
        'body' => request()->body,
    ]);

    $static_content = InfoStaticContent::first()->toArray();

    return Inertia::render('ThanksForYourReview', [
        'title' => 'شكرا لك | مقيم عقاري معتمد - شركة صالح علي الغفيص',
        'description' => 'شكرا لك على تقييمك لشركة صالح علي الغفيص للتقييم العقاري في المملكة. الخط الساخن: 0539455519',
        'static_content' => $static_content
    ]);
});

Route::fallback(function () {
    return Inertia::render('notFoundPage/NotFoundPage', [
        'title' => 'الصفحة غير موجودة | مقيم عقاري معتمد - شركة صالح علي الغفيص',
        'description' => 'الصفحة غير موجودة. الخط الساخن: 0539455519',
    ]);
});
