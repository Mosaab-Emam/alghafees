<?php

namespace App\Http\Requests;

class RequestRate extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                return [
                    'name' => 'required|string|max:255',
                    'mobile' => ['required', 'string', 'regex:/^05[0-9]{8}$/'],
                    'email' => 'required|email:rfc|max:255',
                    'address' => 'required|string|max:255',
                    'goal_id' => 'required|exists:categories,id',
                    'notes' => 'required|string',
                    'type_id' => 'required|exists:categories,id',
                    'real_estate_details' => 'nullable|string',
                    'entity_id' => 'exists:categories,id',
                    'real_estate_age' => 'required|integer|min:1',
                    'real_estate_area' => 'required|integer|min:1',
                    'usage_id' => 'exists:categories,id',
                    'latitude' => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                    'longitude' => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                    'location' => 'required|string|max:255',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'string|max:255',
                    'mobile' => 'string|regex:/^05[0-9]{8}$/',
                    'email' => 'email:rfc|max:255',
                    'address' => 'string|max:255',
                    'goal_id' => 'exists:categories,id',
                    'notes' => 'string',
                    'type_id' => 'exists:categories,id',
                    'real_estate_details' => 'nullable|string',
                    'entity_id' => 'exists:categories,id',
                    'real_estate_age' => 'integer|min:1',
                    'real_estate_area' => 'integer|min:1',
                    'usage_id' => 'exists:categories,id',
                    'latitude' => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                    'longitude' => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                    'location' => 'string|max:255',
                ];
            }
            case 'GET':
            case 'DELETE':
            default: {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'مطلوب',
            'name.max' => '255 حرف كحد أقصى',
            'mobile.required' => 'مطلوب',
            'mobile.regex' => 'رقم الهاتف غير صحيح',
            'email.required' => 'مطلوب',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
            'email.max' => '255 حرف كحد أقصى',
            'address.required' => 'مطلوب',
            'goal_id.required' => 'مطلوب',
            'goal_id.exists' => 'غير موجود',
            'notes.required' => 'مطلوب',
            'type_id.required' => 'مطلوب',
            'type_id.exists' => 'غير موجود',
            'entity_id.exists' => 'غير موجود',
            'real_estate_age.required' => 'مطلوب',
            'real_estate_age.integer' => 'يجب أن يكون عددا',
            'real_estate_age.min' => 'يجب أن يكون عدد أكبر من أو يساوي 1',
            'real_estate_area.required' => 'مطلوب',
            'real_estate_area.integer' => 'يجب أن يكون عددا',
            'real_estate_area.min' => 'يجب أن يكون عدد أكبر من أو يساوي 1',
            'usage_id.exists' => 'غير موجود',
            'latitude.regex' => 'صيغة غير صحيحة',
            'longitude.regex' => 'صيغة غير صحيحة',
            'location.required' => 'مطلوب',
            'location.max' => '255 حرف كحد أقصى'
        ];
    }
}