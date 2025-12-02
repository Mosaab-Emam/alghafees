<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRateRequestRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\InfoStaticContentResource;
use App\Http\Resources\PricePackageResource;
use App\Models\Category;
use App\Models\InfoStaticContent;
use App\Models\PricePackage;
use App\Models\RateRequest;
use App\Models\RequestEvaluationStaticContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
     * @response 201 {
     *   "message": "Rate request submitted successfully",
     *   "data": {
     *     "id": 123,
     *     "request_no": "12300"
     *   }
     * }
     * @response 422 {
     *   "message": "Validation error",
     *   "errors": {}
     * }
     */
    public function store(CreateRateRequestRequest $request)
    {
        // Log the request time and the incoming payload (before validation)
        $requestTime = now()->toDateTimeString();
        $requestPayload = $request->all();

        $logMsg = '[RateRequestController@store] [' . $requestTime . '] Arrived payload: ' . json_encode($requestPayload);

        // Log to log file
        Log::info($logMsg);

        // Log to console (if running in console environment, also error_log for devs)
        if (app()->runningInConsole()) {
            echo $logMsg . PHP_EOL;
        }
        error_log($logMsg);

        $validated = $request->validated();

        // Generate request_no the same way as Website controller
        $validated['request_no'] = !empty(RateRequest::latest()->first()->id) ? RateRequest::latest()->first()->id * 100 : '1000';

        $rateRequest = RateRequest::create($validated);

        return response()->json([
            'message' => 'Rate request submitted successfully',
            'data' => [
                'id' => $rateRequest->id,
                'request_no' => $rateRequest->request_no,
            ]
        ], 201);
    }

    /**
     * Track Rate Request
     *
     * Track the status of a rate request by request number or email.
     *
     * @queryParam request_no string The request number. Example: 12300
     * @queryParam email string Customer email. Example: ahmed@example.com
     *
     * @response 200 {
     *   "data": {
     *     "id": 123,
     *     "request_no": "12300",
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
            'request_no' => 'required_without:email|string',
            'email' => 'required_without:request_no|email',
        ]);

        $query = RateRequest::query();

        if ($request->has('request_no')) {
            $query->where('request_no', $request->request_no);
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
                'request_no' => $rateRequest->request_no,
                'status' => $rateRequest->status,
                'created_at' => $rateRequest->created_at->format('Y-m-d'),
            ]
        ]);
    }
}

