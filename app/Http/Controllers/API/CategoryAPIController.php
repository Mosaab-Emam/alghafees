<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryAPIController extends ResponseController
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function goals(Request $request)
    {
        $data = $this->categoryRepository->getPublishCategories('ApartmentGoal', 999, $request->input('list', []));

        return $this->successResponse(
            CategoryResource::collection($data),
            'Goals retrieved successfully',
            200
        );
    }

    public function types(Request $request)
    {
        $data = $this->categoryRepository->getPublishCategories('ApartmentType', 999, $request->input('list', []));

        return $this->successResponse(
            CategoryResource::collection($data),
            'Property types retrieved successfully',
            200
        );
    }

    public function entities(Request $request)
    {
        $data = $this->categoryRepository->getPublishCategories('ApartmentEntity', 999, $request->input('list', []));

        return $this->successResponse(
            CategoryResource::collection($data),
            'Entities retrieved successfully',
            200
        );
    }

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
