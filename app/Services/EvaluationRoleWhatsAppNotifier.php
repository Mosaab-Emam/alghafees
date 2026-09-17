<?php

namespace App\Services;

use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Evaluation\EvaluationTransaction;
use Illuminate\Support\Facades\Log;
use Throwable;

class EvaluationRoleWhatsAppNotifier
{
    public function send(int $transactionId, int $employeeId, string $roleField, string $transactionNumber): void
    {
        $context = [
            'transaction_id' => $transactionId,
            'employee_id' => $employeeId,
            'role' => $roleField,
        ];

        try {
            $label = EvaluationTransaction::ASSIGNMENT_ROLE_LABELS[$roleField] ?? null;
            $transaction = EvaluationTransaction::withoutGlobalScopes()->find($transactionId);
            if (!$label || !$transaction || (int) $transaction->getAttribute($roleField) !== $employeeId) {
                return;
            }

            $employee = EvaluationEmployee::withoutGlobalScopes()->find($employeeId);
            if (!$employee || !$employee->phone) {
                Log::info('Evaluation role WhatsApp notification skipped: employee has no phone', $context);
                return;
            }
            if (!preg_match('/^\+[1-9][0-9]{7,14}$/', $employee->phone)) {
                Log::warning('Evaluation role WhatsApp notification skipped: invalid employee phone', $context);
                return;
            }

            $message = "مرحباً {$employee->title}،\nتم إسناد دور «{$label}» إليك في معاملة التقييم رقم {$transactionNumber}.\nيرجى متابعة المعاملة في النظام.\nشركة صالح الغفيص للتقييم العقاري";
            app(WhatsAppService::class)->sendMessage($employee->phone, $message, false);
        } catch (Throwable $exception) {
            // Delivery failures must not interrupt the saved evaluation or the remaining notifications.
            Log::error('Evaluation role WhatsApp notification failed', $context + [
                'exception' => get_class($exception),
            ]);
        }
    }
}
