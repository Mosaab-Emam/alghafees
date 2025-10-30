<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqStaticContentResource;
use App\Http\Resources\InfoStaticContentResource;
use App\Models\ContactUsStaticContent;
use App\Models\FaqStaticContents;
use App\Models\InfoStaticContent;
use App\Models\OurClientsStaticContent;
use App\Models\TrackYourRequestStaticContent;

/**
 * @group Static Content
 *
 * APIs for various static page content
 */
class StaticContentController extends Controller
{
    /**
     * Get Contact Us Page Data
     *
     * Returns static content for the contact us page.
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {},
     *     "info_content": {}
     *   }
     * }
     */
    public function contactUs()
    {
        $contactContent = ContactUsStaticContent::first();
        $infoContent = InfoStaticContent::first();

        return response()->json([
            'data' => [
                'static_content' => $contactContent,
                'info_content' => new InfoStaticContentResource($infoContent),
            ]
        ]);
    }

    /**
     * Get Track Your Request Page Data
     *
     * Returns static content for the track your request page.
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {},
     *     "info_content": {}
     *   }
     * }
     */
    public function trackYourRequest()
    {
        $trackContent = TrackYourRequestStaticContent::first();
        $infoContent = InfoStaticContent::first();

        return response()->json([
            'data' => [
                'static_content' => $trackContent,
                'info_content' => new InfoStaticContentResource($infoContent),
            ]
        ]);
    }

    /**
     * Get FAQ Page Data
     *
     * Returns static content for the FAQ page.
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {},
     *     "info_content": {}
     *   }
     * }
     */
    public function faq()
    {
        $faqContent = FaqStaticContents::first();
        $infoContent = InfoStaticContent::first();

        return response()->json([
            'data' => [
                'static_content' => new FaqStaticContentResource($faqContent),
                'info_content' => new InfoStaticContentResource($infoContent),
            ]
        ]);
    }

    /**
     * Get Privacy Policy Page Data
     *
     * Returns static content for the privacy policy page.
     *
     * @response 200 {
     *   "data": {
     *     "info_content": {}
     *   }
     * }
     */
    public function privacyPolicy()
    {
        $infoContent = InfoStaticContent::first();

        return response()->json([
            'data' => [
                'info_content' => new InfoStaticContentResource($infoContent),
            ]
        ]);
    }

    /**
     * Get Our Clients Page Data
     *
     * Returns static content and client logos for the our clients page.
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {},
     *     "info_content": {},
     *     "clients": []
     *   }
     * }
     */
    public function ourClients()
    {
        $clientsContent = OurClientsStaticContent::first();
        $infoContent = InfoStaticContent::first();
        
        return response()->json([
            'data' => [
                'static_content' => $clientsContent,
                'info_content' => new InfoStaticContentResource($infoContent),
            ]
        ]);
    }
}

