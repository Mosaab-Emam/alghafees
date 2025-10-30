<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\InfoStaticContentResource;
use App\Http\Resources\PricePackageResource;
use App\Models\Category;
use App\Models\InfoStaticContent;
use App\Models\PricePackage;
use App\Models\RateRequest;
use App\Models\RequestEvaluationStaticContent;
use Illuminate\Http\Request;

/**
 * @group Rate Requests
 *
 * APIs for managing rate/evaluation requests
 */
class RateRequestController extends Controller
{
    /**
     * Get Request Evaluation Page Data
     *
     * Returns all data needed for the request evaluation form including categories and price packages.
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {},
     *     "info_content": {},
     *     "goals": [],
     *     "types": [],
     *     "entities": [],
     *     "usage": [],
     *     "price_packages": []
     *   }
     * }
     */
    public function formData()
    {
        $requestEvalContent = RequestEvaluationStaticContent::first();
        $infoContent = InfoStaticContent::first();
        $goals = Category::apartmentGoal()->get();
        $types = Category::apartmentType()->get();
        $entities = Category::apartmentEntity()->get();
        $usage = Category::apartmentUsage()->get();
        $pricePackages = PricePackage::all();

        return response()->json([
            'data' => [
                'static_content' => $requestEvalContent,
                'info_content' => new InfoStaticContentResource($infoContent),
                'goals' => CategoryResource::collection($goals),
                'types' => CategoryResource::collection($types),
                'entities' => CategoryResource::collection($entities),
                'usage' => CategoryResource::collection($usage),
                'price_packages' => PricePackageResource::collection($pricePackages),
            ]
        ]);
    }

    /**
     * Submit Rate Request
     *
     * Submit a new rate/evaluation request.
     *
     * @bodyParam goal_id integer required The goal category ID. Example: 1
     * @bodyParam type_id integer required The type category ID. Example: 2
     * @bodyParam entity_id integer required The entity category ID. Example: 1
     * @bodyParam usage_id integer required The usage category ID. Example: 3
     * @bodyParam price_package_id integer The selected price package ID. Example: 1
     * @bodyParam name string required Customer name. Example: Ahmed Ali
     * @bodyParam email string required Customer email. Example: ahmed@example.com
     * @bodyParam phone string required Customer phone. Example: 0501234567
     * @bodyParam property_location string required Property location. Example: Riyadh, Al Olaya
     * @bodyParam property_description string Property description. Example: 3 bedroom villa
     * @bodyParam notes string Additional notes.
     *
     * @response 200 {
     *   "message": "Rate request submitted successfully",
     *   "data": {
     *     "id": 123,
     *     "request_number": "REQ-2025-00123"
     *   }
     * }
     * @response 422 {
     *   "message": "Validation error",
     *   "errors": {}
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'goal_id' => 'required|exists:categories,id',
            'type_id' => 'required|exists:categories,id',
            'entity_id' => 'required|exists:categories,id',
            'usage_id' => 'required|exists:categories,id',
            'price_package_id' => 'nullable|exists:price_packages,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'property_location' => 'required|string',
            'property_description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $rateRequest = RateRequest::create($validated);

        return response()->json([
            'message' => 'Rate request submitted successfully',
            'data' => [
                'id' => $rateRequest->id,
                'request_number' => $rateRequest->request_number ?? 'REQ-' . str_pad($rateRequest->id, 6, '0', STR_PAD_LEFT),
            ]
        ], 201);
    }

    /**
     * Track Rate Request
     *
     * Track the status of a rate request by request number or email.
     *
     * @queryParam request_number string The request number. Example: REQ-2025-00123
     * @queryParam email string Customer email. Example: ahmed@example.com
     *
     * @response 200 {
     *   "data": {
     *     "id": 123,
     *     "request_number": "REQ-2025-00123",
     *     "status": "pending",
     *     "created_at": "2025-01-15"
     *   }
     * }
     * @response 404 {
     *   "message": "Request not found"
     * }
     */
    public function track(Request $request)
    {
        $request->validate([
            'request_number' => 'required_without:email|string',
            'email' => 'required_without:request_number|email',
        ]);

        $query = RateRequest::query();

        if ($request->has('request_number')) {
            $query->where('request_number', $request->request_number);
        }

        if ($request->has('email')) {
            $query->orWhere('email', $request->email);
        }

        $rateRequest = $query->first();

        if (!$rateRequest) {
            return response()->json([
                'message' => 'Request not found'
            ], 404);
        }

        return response()->json([
            'data' => [
                'id' => $rateRequest->id,
                'request_number' => $rateRequest->request_number ?? 'REQ-' . str_pad($rateRequest->id, 6, '0', STR_PAD_LEFT),
                'status' => $rateRequest->status,
                'created_at' => $rateRequest->created_at->format('Y-m-d'),
            ]
        ]);
    }
}

