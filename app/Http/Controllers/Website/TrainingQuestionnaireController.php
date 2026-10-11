<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingQuestionnaireRequest;
use App\Services\TrainingQuestionnaireDelivery;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrainingQuestionnaireController extends Controller
{
    public function show(): Response
    {
        return Inertia::render('training/TrainingQuestionnaire', [
            'title' => 'استكمال إجراءات التدريب | شركة صالح علي الغفيص',
            'description' => 'نموذج استكمال البيانات المطلوبة لإجراءات التدريب.',
            'noindex' => true,
            'questions' => config('training.questions'),
        ])->toResponse(request())->header('X-Robots-Tag', 'noindex, nofollow, noarchive');
    }

    public function store(TrainingQuestionnaireRequest $request, TrainingQuestionnaireDelivery $delivery): JsonResponse
    {
        $answers = $request->safe()->except('website');
        try {
            $result = $delivery->send($answers);
        } catch (Throwable $exception) {
            Log::error('Training questionnaire delivery configuration failed.', [
                'exception_type' => get_class($exception),
                'reason' => $exception instanceof InvalidArgumentException ? $exception->getMessage() : null,
            ]);

            return response()->json([
                'message' => 'تعذر إرسال بياناتك حاليًا. بياناتك ما زالت في النموذج، يرجى المحاولة لاحقًا.',
            ], 503);
        }

        if ($result['failed'] !== []) {
            return response()->json([
                'message' => $result['sent'] !== []
                    ? 'تم استلام بياناتك، لكن تعذر إكمال إرسالها عبر جميع وسائل التواصل. بياناتك ما زالت في النموذج، يرجى المحاولة لاحقًا.'
                    : 'تعذر إرسال بياناتك حاليًا. بياناتك ما زالت في النموذج، يرجى المحاولة لاحقًا.',
            ], 503);
        }

        return response()->json(['message' => 'تم إرسال بياناتك بنجاح.']);
    }
}
