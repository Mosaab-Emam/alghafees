<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContentResource;
use App\Http\Resources\InfoStaticContentResource;
use App\Http\Resources\OurServicesStaticContentResource;
use App\Models\Content;
use App\Models\InfoStaticContent;
use App\Models\OurServicesStaticContent;

/**
 * @group Services
 *
 * APIs for services data
 */
class ServicesController extends Controller
{
    /**
     * Get Services Page Data
     *
     * Returns all data needed for the services page.
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {
     *       "id": 1,
     *       "hero_title": "Our Services"
     *     },
     *     "info_content": {
     *       "id": 1
     *     }
     *   }
     * }
     */
    public function index()
    {
        $servicesContent = OurServicesStaticContent::first();
        $infoContent = InfoStaticContent::first();

        return response()->json([
            'data' => [
                'static_content' => new OurServicesStaticContentResource($servicesContent),
                'info_content' => new InfoStaticContentResource($infoContent),
            ]
        ]);
    }

    /**
     * List All Services
     *
     * Returns a list of all active services.
     *
     * @response 200 {
     *   "data": []
     * }
     */
    public function list()
    {
        $services = Content::service()->publish()->ordered()->get();

        return response()->json([
            'data' => ContentResource::collection($services)
        ]);
    }

    /**
     * Get Single Service
     *
     * Returns details of a specific service.
     *
     * @urlParam id integer required The ID of the service. Example: 1
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "title": "Real Estate Valuation",
     *     "description": "Professional valuation services"
     *   }
     * }
     * @response 404 {
     *   "message": "Service not found"
     * }
     */
    public function show($id)
    {
        $service = Content::service()->publish()->find($id);

        if (!$service) {
            return response()->json([
                'message' => 'Service not found'
            ], 404);
        }

        return response()->json([
            'data' => new ContentResource($service)
        ]);
    }
}

