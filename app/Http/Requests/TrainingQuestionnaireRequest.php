<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TrainingQuestionnaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this->input('phone'))) {
            $phone = strtr($this->input('phone'), [
                '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
                '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
                '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
                '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            ]);

            $this->merge(['phone' => preg_replace('/[\s()-]+/u', '', $phone)]);
        }
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:150', 'not_regex:/[\r\n]/'],
            'email' => ['required', 'string', 'email:rfc', 'max:254'],
            'phone' => ['required', 'string', 'regex:/^\+?[0-9]{7,15}$/'],
            'website' => ['prohibited'],
        ];

        foreach (config('training.questions') as $name => $question) {
            $rules[$name] = ['required', 'string', Rule::in(array_keys($question['options']))];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'يرجى إدخال الاسم الكامل.',
            'name.string' => 'يرجى إدخال اسم صحيح.',
            'name.max' => 'يجب ألا يتجاوز الاسم ١٥٠ حرفًا.',
            'name.not_regex' => 'يرجى كتابة الاسم في سطر واحد.',
            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'email.string' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.max' => 'البريد الإلكتروني أطول من الحد المسموح.',
            'phone.required' => 'يرجى إدخال رقم الجوال.',
            'phone.string' => 'يرجى إدخال رقم جوال صحيح.',
            'phone.regex' => 'يرجى إدخال رقم جوال من ٧ إلى ١٥ رقمًا، مع رمز الدولة عند الحاجة.',
            'website.prohibited' => 'تعذر إرسال النموذج. يرجى المحاولة مرة أخرى.',
            'required' => 'يرجى اختيار إجابة لهذا السؤال.',
            'string' => 'يرجى اختيار إجابة صحيحة.',
            'in' => 'يرجى اختيار إحدى الإجابات المتاحة.',
        ];
    }
}
