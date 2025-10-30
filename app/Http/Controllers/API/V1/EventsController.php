<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\InfoStaticContentResource;
use App\Models\Event;
use App\Models\EventsStaticContent;
use App\Models\InfoStaticContent;

/**
 * @group Events
 *
 * APIs for events data
 */
class EventsController extends Controller
{
    /**
     * List All Events
     *
     * Returns a list of all events with static content.
     *
     * @response 200 {
     *   "data": {
     *     "static_content": {},
     *     "info_content": {},
     *     "events": []
     *   }
     * }
     */
    public function index()
    {
        $eventsContent = EventsStaticContent::first();
        $infoContent = InfoStaticContent::first();
        $events = Event::orderBy('id', 'desc')->get();

        return response()->json([
            'data' => [
                'static_content' => $eventsContent,
                'info_content' => new InfoStaticContentResource($infoContent),
                'events' => EventResource::collection($events),
            ]
        ]);
    }

    /**
     * Get Single Event
     *
     * Returns details of a specific event.
     *
     * @urlParam id integer required The ID of the event. Example: 1
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "title": "Annual Conference",
     *     "date": "2025-12-01",
     *     "location": "Riyadh"
     *   }
     * }
     * @response 404 {
     *   "message": "Event not found"
     * }
     */
    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'message' => 'Event not found'
            ], 404);
        }

        return response()->json([
            'data' => new EventResource($event)
        ]);
    }
}

