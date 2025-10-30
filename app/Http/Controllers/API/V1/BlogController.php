<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogPostResource;
use App\Http\Resources\InfoStaticContentResource;
use App\Http\Resources\TagResource;
use App\Models\BlogStaticContent;
use App\Models\InfoStaticContent;
use Illuminate\Http\Request;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;

/**
 * @group Blog
 *
 * APIs for blog posts and tags
 */
class BlogController extends Controller
{
    /**
     * List Blog Posts
     *
     * Returns a paginated list of blog posts with optional search and tag filtering.
     *
     * @queryParam search string Filter posts by title. Example: real estate
     * @queryParam tag string Filter posts by tag slug. Example: valuation
     * @queryParam page integer Page number for pagination. Example: 1
     * @queryParam per_page integer Number of items per page. Defaults to 9. Example: 9
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {},
     *     "info_content": {},
     *     "posts": {
     *       "data": [],
     *       "current_page": 1,
     *       "last_page": 3,
     *       "per_page": 9,
     *       "total": 25
     *     },
     *     "tags": []
     *   }
     * }
     */
    public function index(Request $request)
    {
        $blogContent = BlogStaticContent::first();
        $infoContent = InfoStaticContent::first();
        
        $searchQuery = $request->input('search');
        $tagSlug = $request->input('tag');
        $perPage = $request->input('per_page', 9);

        $query = Post::orderBy('published_at', 'desc')
            ->when($searchQuery, function ($queryBuilder) use ($searchQuery) {
                return $queryBuilder->where('title', 'like', '%' . $searchQuery . '%');
            })
            ->when($tagSlug, function ($queryBuilder) use ($tagSlug) {
                return $queryBuilder->whereHas('tags', function ($query) use ($tagSlug) {
                    $query->where('slug->ar', $tagSlug);
                });
            });

        $posts = $query->with('tags')->paginate($perPage);

        $tags = Tag::withCount('postsPublished')
            ->orderBy('posts_published_count', 'desc')
            ->get();

        return response()->json([
            'data' => [
                'static_content' => $blogContent,
                'info_content' => new InfoStaticContentResource($infoContent),
                'posts' => [
                    'data' => BlogPostResource::collection($posts->items()),
                    'current_page' => $posts->currentPage(),
                    'last_page' => $posts->lastPage(),
                    'per_page' => $posts->perPage(),
                    'total' => $posts->total(),
                ],
                'tags' => TagResource::collection($tags),
            ]
        ]);
    }

    /**
     * Get Single Blog Post
     *
     * Returns details of a specific blog post by slug.
     *
     * @urlParam slug string required The slug of the post. Example: real-estate-market-2025
     *
     * @response 200 {
     *   "data": {
     *     "post": {
     *       "id": 1,
     *       "title": "Real Estate Market 2025",
     *       "content": "...",
     *       "published_at": "2025-01-15"
     *     },
     *     "latest_posts": [],
     *     "related_posts": []
     *   }
     * }
     * @response 404 {
     *   "message": "Post not found"
     * }
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with('tags')->first();

        if (!$post) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }

        $latestPosts = Post::orderBy('published_at', 'desc')
            ->where('id', '!=', $post->id)
            ->limit(2)
            ->get();

        $relatedPosts = Post::withAnyTagsOfAnyType($post->tags)
            ->where('id', '!=', $post->id)
            ->limit(3)
            ->get();

        return response()->json([
            'data' => [
                'post' => new BlogPostResource($post),
                'latest_posts' => BlogPostResource::collection($latestPosts),
                'related_posts' => BlogPostResource::collection($relatedPosts),
            ]
        ]);
    }

    /**
     * List All Tags
     *
     * Returns a list of all blog tags with post counts.
     *
     * @response 200 {
     *   "data": []
     * }
     */
    public function tags()
    {
        $tags = Tag::withCount('postsPublished')
            ->orderBy('posts_published_count', 'desc')
            ->get();

        return response()->json([
            'data' => TagResource::collection($tags)
        ]);
    }
}

