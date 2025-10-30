<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\InfoStaticContentResource;
use App\Http\Resources\TrainingTypeResource;
use App\Models\InfoStaticContent;
use App\Models\JoinUsStaticContent;
use App\Models\TrainingApplication;
use App\Models\TrainingType;
use Illuminate\Http\Request;

/**
 * @group Training
 *
 * APIs for training applications
 */
class TrainingController extends Controller
{
    /**
     * Get Training Page Data
     *
     * Returns training types and static content for the join us page.
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {},
     *     "info_content": {},
     *     "training_types": []
     *   }
     * }
     */
    public function index()
    {
        $joinUsContent = JoinUsStaticContent::first();
        $infoContent = InfoStaticContent::first();
        $trainingTypes = TrainingType::all();

        return response()->json([
            'data' => [
                'static_content' => $joinUsContent,
                'info_content' => new InfoStaticContentResource($infoContent),
                'training_types' => TrainingTypeResource::collection($trainingTypes),
            ]
        ]);
    }

    /**
     * Submit Training Application
     *
     * Submit a new training application.
     *
     * @bodyParam trainingType integer required The training type ID. Example: 1
     * @bodyParam cv_file file required CV file (PDF, DOC, DOCX, max 2MB).
     * @bodyParam university_name string required University name. Example: King Saud University
     * @bodyParam training_period string required Training period. Example: 3 months
     * @bodyParam starting_date date required Starting date. Example: 2025-01-15
     * @bodyParam phone_number string required Phone number. Example: 0501234567
     *
     * @response 200 {
     *   "message": "Training application submitted successfully",
     *   "data": {}
     * }
     * @response 422 {
     *   "message": "Validation error",
     *   "errors": {}
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trainingType' => 'required|exists:training_types,id',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'university_name' => 'required|string|max:255',
            'training_period' => 'required|string|max:255',
            'starting_date' => 'required|date',
            'phone_number' => 'required|string',
        ]);

        $cvPath = $request->file('cv_file')->store('upload/cvs', 'public');

        $application = TrainingApplication::create([
            'training_type_id' => $validated['trainingType'],
            'cv_file' => $cvPath,
            'university_name' => $validated['university_name'],
            'training_period' => $validated['training_period'],
            'starting_date' => $validated['starting_date'],
            'phone_number' => $validated['phone_number'],
        ]);

        return response()->json([
            'message' => 'Training application submitted successfully',
            'data' => $application
        ]);
    }
}

