<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

/**
 * @group Categories
 *
 * APIs for various category types
 */
class CategoriesController extends Controller
{
    /**
     * Get Apartment Goals
     *
     * Returns all apartment goal categories.
     *
     * @response 200 {
     *   "data": []
     * }
     */
    public function goals()
    {
        $goals = Category::apartmentGoal()->publish()->ordered()->get();

        return response()->json([
            'data' => CategoryResource::collection($goals)
        ]);
    }

    /**
     * Get Apartment Types
     *
     * Returns all apartment type categories.
     *
     * @response 200 {
     *   "data": []
     * }
     */
    public function types()
    {
        $types = Category::apartmentType()->publish()->ordered()->get();

        return response()->json([
            'data' => CategoryResource::collection($types)
        ]);
    }

    /**
     * Get Apartment Entities
     *
     * Returns all apartment entity categories.
     *
     * @response 200 {
     *   "data": []
     * }
     */
    public function entities()
    {
        $entities = Category::apartmentEntity()->publish()->ordered()->get();

        return response()->json([
            'data' => CategoryResource::collection($entities)
        ]);
    }

    /**
     * Get Apartment Usage
     *
     * Returns all apartment usage categories.
     *
     * @response 200 {
     *   "data": []
     * }
     */
    public function usages()
    {
        $usages = Category::apartmentUsage()->publish()->ordered()->get();

        return response()->json([
            'data' => CategoryResource::collection($usages)
        ]);
    }
}

