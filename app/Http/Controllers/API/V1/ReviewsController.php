<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

/**
 * @group Reviews
 *
 * APIs for managing customer reviews
 */
class ReviewsController extends Controller
{
    /**
     * List All Reviews
     *
     * Returns a list of all completed reviews.
     *
     * @response 200 {
     *   "data": []
     * }
     */
    public function index()
    {
        $reviews = Review::whereNotNull('name')
            ->whereNotNull('description')
            ->whereNotNull('image')
            ->whereNotNull('rating')
            ->whereNotNull('body')
            ->get();

        return response()->json([
            'data' => ReviewResource::collection($reviews)
        ]);
    }

    /**
     * Submit a Review
     *
     * Submit a customer review using the provided token.
     *
     * @bodyParam review_token string required The review token. Example: abc123xyz
     * @bodyParam name string required Customer name. Example: Ahmed Ali
     * @bodyParam description string required Customer job title or description. Example: CEO of ABC Company
     * @bodyParam image file required Customer photo.
     * @bodyParam rating integer required Rating from 1 to 5. Example: 5
     * @bodyParam body string required Review text. Example: Excellent service!
     *
     * @response 200 {
     *   "message": "Review submitted successfully",
     *   "data": {}
     * }
     * @response 404 {
     *   "message": "Invalid or already used review token"
     * }
     * @response 422 {
     *   "message": "Validation error",
     *   "errors": {}
     * }
     */
    public function store(Request $request)
    {
        $request->validate([
            'review_token' => 'required|string',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'body' => 'required|string',
        ]);

        $review = Review::where('token', $request->review_token)->first();
        
        if (!$review || $review->name != null) {
            return response()->json([
                'message' => 'Invalid or already used review token'
            ], 404);
        }

        $imagePath = $request->file('image')->store('reviews', 'public');

        $review->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'rating' => $request->rating,
            'body' => $request->body,
        ]);

        return response()->json([
            'message' => 'Review submitted successfully',
            'data' => new ReviewResource($review)
        ]);
    }

    /**
     * Check Review Token
     *
     * Check if a review token is valid and not yet used.
     *
     * @urlParam token string required The review token to check. Example: abc123xyz
     *
     * @response 200 {
     *   "valid": true,
     *   "message": "Token is valid"
     * }
     * @response 404 {
     *   "valid": false,
     *   "message": "Token is invalid or already used"
     * }
     */
    public function checkToken($token)
    {
        $review = Review::where('token', $token)->first();

        if (!$review || $review->is_filled) {
            return response()->json([
                'valid' => false,
                'message' => 'Token is invalid or already used'
            ], 404);
        }

        return response()->json([
            'valid' => true,
            'message' => 'Token is valid'
        ]);
    }
}

