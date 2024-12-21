<?php

namespace App\Http\Requests;

/**
 * @bodyParam name string required The name of the requester. Example: رضا عياد
 * @bodyParam mobile string required Must match the regex /^05[0-9]{8}$/. Example: 0545853228
 * @bodyParam email string required The email of the requester. Example: redayadmm1234@gmail.com
 * @bodyParam address string required The address of the requester. Example: شارع النصر، حي النصر، مدينة الرياض
 * @bodyParam goal_id integer required The id of an existing record in the categories table. Example: 1
 * @bodyParam notes string required Additional information. Example: يرجى التواصل معي في أقرب وقت ممكن
 * @bodyParam type_id integer required The id of an existing record in the categories table. Example: 1
 * @bodyParam real_estate_details string More details about the property. Example: يحتوي على 3 غرف نوم وصالة ومطبخ وحمامين
 * @bodyParam entity_id integer The id of an existing record in the categories table. Example: 1
 * @bodyParam real_estate_age integer required The age of the property. Example: 5
 * @bodyParam real_estate_area integer required The area of the property in square meters. Example: 200
 * @bodyParam usage_id integer The id of an existing record in the categories table. Example: 1
 * @bodyParam latitude numeric Between -90 and 90. Example: 24.7136
 * @bodyParam longitude numeric Between -180 and 180. Example: 46.6753
 * @bodyParam location string required The location of the property. Example: شارع النصر، حي النصر، مدينة الرياض
 */
class CreateRateRequestRequest extends Request
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
                    'latitude' => ['nullable', 'numeric', 'between:-90,90'],
                    'longitude' => ['nullable', 'numeric', 'between:-180,180'],
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
                    'latitude' => ['nullable', 'numeric', 'between:-90,90'],
                    'longitude' => ['nullable', 'numeric', 'between:-180,180'],
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