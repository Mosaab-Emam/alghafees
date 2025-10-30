<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InfoStaticContentResource;
use App\Http\Resources\PricePackageResource;
use App\Http\Resources\PricingStaticContentResource;
use App\Models\InfoStaticContent;
use App\Models\PricePackage;
use App\Models\PricingStaticContent;

/**
 * @group Pricing
 *
 * APIs for pricing data
 */
class PricingController extends Controller
{
    /**
     * Get Pricing Page Data
     *
     * Returns all pricing packages and static content.
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {},
     *     "info_content": {},
     *     "price_packages": []
     *   }
     * }
     */
    public function index()
    {
        $pricingContent = PricingStaticContent::first();
        $infoContent = InfoStaticContent::first();
        $pricePackages = PricePackage::all();

        return response()->json([
            'data' => [
                'static_content' => new PricingStaticContentResource($pricingContent),
                'info_content' => new InfoStaticContentResource($infoContent),
                'price_packages' => PricePackageResource::collection($pricePackages),
            ]
        ]);
    }
}

