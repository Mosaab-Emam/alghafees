<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\RequestRate;
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
     * Add a request to the database
     *
     * This endpoint accepts a new rate request input.
     * 
     */
    public function store(RequestRate $request)
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

        // $title = 'رسائل الموقع رقم ' . $data['request_no'];
        // $content = __('website.RateRequestContent', ['item' => $evaluation]);
        // $view = 'contact';
        // event(new RequestEmailEvent($title, $content, $view, $item));

        return response()->json([
            "data" => $evaluation
        ]);

        return $this->successResponse([], trans(' تم استلام طلبك رقم ' . $data['request_no'] . 'سيقوم فريق العمل بشركة صالح الغفيص للتقييم العقارى بالتواصل معك قريباَ'), 200);
    }


    public function tracking(request $request)
    {
        if ($request->request_no) {
            $trackId = $request->request_no;

            $order = RateRequest::where('request_no', '=', $trackId)->first();
            if ($order) {
                $orderDetails = $order->getStatusApi();

                return response()->json(
                    [
                        'order' => $order,
                        'status' => $orderDetails,
                    ],
                    200
                );



            } else {
                return response()->json([
                    'message' => 'لا يوجد طلب بهذا الرقم' . $trackId . '',
                ], 503);
            }
        } else {
            return response()->json([
                'message' => 'يجب أدخال رقم الطلب',
            ], 503);
        }

    }
}