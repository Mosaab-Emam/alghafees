<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CreateRateRequestRequest;
use Illuminate\Http\Request;
use App\Models\RateRequest;
use App\Interfaces\RateRequestRepositoryInterface;

/**
 * @group Rate Requests
 *
 * APIs for rate requests
 */
class RateRequestAPIController extends ResponseController
{
    private RateRequestRepositoryInterface $rateRepository;

    public function __construct(
        RateRequestRepositoryInterface $rateRepository,
    ) {
        $this->rateRepository = $rateRepository;
    }

    /**
     * POST Add a request to the database
     *
     * This endpoint accepts a new rate request input.
     * 
     */
    public function store(CreateRateRequestRequest $request)
    {
        $data = $request->all();

        $data['request_no'] = !empty(RateRequest::latest()->first()->id) ? RateRequest::latest()->first()->id * 100 : '1000';
        $images = $this->rateRepository->getImagesSettings();
        $evaluation = $this->rateRepository->createRateRequest($data);

        foreach ($images as $item) {
            if (!empty($data[$item])) {
                $evaluation->addMultipleMediaFromRequest([$item])
                    ->each(function ($fileAdder) use ($item) {
                        $fileAdder->toMediaCollection($item);
                    });
            }
        }

        return $this->successResponse(
            $evaluation,
            'Rate request created successfully',
            200
        );
    }

    /**
     * GET Track a request
     *
     * This endpoint tracks a rate request by its request number.
     * 
     */
    public function tracking(Request $request)
    {
        if ($request->request_no) {
            $trackId = $request->request_no;

            $order = RateRequest::where('request_no', '=', $trackId)->first();
            if ($order) {
                $orderDetails = $order->getStatusApi();

                return $this->successResponse(
                    [
                        'order' => $order,
                        'status' => $orderDetails,
                    ],
                    'Order tracked successfully',
                    200
                );
            } else {
                return $this->successResponse(
                    null,
                    'No order found with this number: ' . $trackId,
                    503
                );
            }
        } else {
            return $this->successResponse(
                null,
                'Request number is required',
                503
            );
        }
    }
}