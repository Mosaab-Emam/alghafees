<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;

/**
 * @group Categories
 *
 * APIs for categories
 */
class CategoryAPIController extends ResponseController
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Fetch goals
     *
     * This endpoint fetches all goals.
     * 
     */
    public function goals(Request $request)
    {
        $data = $this->categoryRepository->getPublishCategories('ApartmentGoal', 999, $request->input('list', []));

        return $this->successResponse(
            CategoryResource::collection($data),
            'Goals retrieved successfully',
            200
        );
    }

    /**
     * Fetch types
     *
     * This endpoint fetches all types.
     * 
     */
    public function types(Request $request)
    {
        $data = $this->categoryRepository->getPublishCategories('ApartmentType', 999, $request->input('list', []));

        return $this->successResponse(
            CategoryResource::collection($data),
            'Property types retrieved successfully',
            200
        );
    }

    /**
     * Fetch entities
     *
     * This endpoint fetches all entities.
     * 
     */
    public function entities(Request $request)
    {
        $data = $this->categoryRepository->getPublishCategories('ApartmentEntity', 999, $request->input('list', []));

        return $this->successResponse(
            CategoryResource::collection($data),
            'Entities retrieved successfully',
            200
        );
    }

    /**
     * Fetch usages
     *
     * This endpoint fetches all usages.
     * 
     */
    public function usages(Request $request)
    {
        $data = $this->categoryRepository->getPublishCategories('ApartmentUsage', 999, $request->input('list', []));

        return $this->successResponse(
            CategoryResource::collection($data),
            'Usages retrieved successfully',
            200
        );
    }
}
