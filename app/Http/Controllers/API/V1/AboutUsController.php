<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutUsStaticContentResource;
use App\Http\Resources\FileResource;
use App\Http\Resources\InfoStaticContentResource;
use App\Models\AboutUsStaticContent;
use App\Models\File;
use App\Models\InfoStaticContent;

/**
 * @group About Us
 *
 * APIs for about us page data
 */
class AboutUsController extends Controller
{
    /**
     * Get About Us Page Data
     *
     * Returns all data needed for the about us page including static content, reports, and evaluations.
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {
     *       "id": 1,
     *       "hero_title": "About Us",
     *       "who_are_we_title": "Who We Are"
     *     },
     *     "info_content": {
     *       "id": 1,
     *       "footer_phone": "0539455519"
     *     },
     *     "reports": [],
     *     "evaluations": []
     *   }
     * }
     */
    public function index()
    {
        $aboutContent = AboutUsStaticContent::first();
        $infoContent = InfoStaticContent::first();
        $reports = File::reports()->get();
        $evaluations = File::evaluations()->get();

        return response()->json([
            'data' => [
                'static_content' => new AboutUsStaticContentResource($aboutContent),
                'info_content' => new InfoStaticContentResource($infoContent),
                'reports' => FileResource::collection($reports),
                'evaluations' => FileResource::collection($evaluations),
            ]
        ]);
    }
}

