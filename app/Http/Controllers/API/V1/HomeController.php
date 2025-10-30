<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\HomeStaticContentResource;
use App\Http\Resources\InfoStaticContentResource;
use App\Http\Resources\FileResource;
use App\Http\Resources\ReviewResource;
use App\Models\Event;
use App\Models\File;
use App\Models\HomeStaticContent;
use App\Models\InfoStaticContent;
use App\Models\Review;
use App\Models\Content;

/**
 * @group Home
 *
 * APIs for managing home page data
 */
class HomeController extends Controller
{
    /**
     * Get Home Page Data
     *
     * Returns all data needed for the home page including static content, events, reviews, and partners.
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {
     *       "id": 1,
     *       "hero_title": "Welcome to Alghafis",
     *       "hero_description": "Professional Real Estate Valuation"
     *     },
     *     "info_content": {
     *       "id": 1,
     *       "header_logo": "/images/logo.png",
     *       "footer_phone": "0539455519"
     *     },
     *     "report": {
     *       "id": 1,
     *       "title": "Annual Report",
     *       "file": "/files/report.pdf"
     *     },
     *     "events": [],
     *     "reviews": [],
     *     "partners": []
     *   }
     * }
     */
    public function index()
    {
        $homeContent = HomeStaticContent::first();
        $infoContent = InfoStaticContent::first();
        $report = File::reports()->first();
        $events = Event::orderBy('id', 'desc')->take(2)->get();
        $reviews = Review::whereNotNull('name')
            ->whereNotNull('description')
            ->whereNotNull('image')
            ->whereNotNull('rating')
            ->whereNotNull('body')
            ->get();
        $partners = Content::client()->pluck('image');

        return response()->json([
            'data' => [
                'static_content' => new HomeStaticContentResource($homeContent),
                'info_content' => new InfoStaticContentResource($infoContent),
                'report' => $report ? new FileResource($report) : null,
                'events' => EventResource::collection($events),
                'reviews' => ReviewResource::collection($reviews),
                'partners' => $partners,
            ]
        ]);
    }
}

