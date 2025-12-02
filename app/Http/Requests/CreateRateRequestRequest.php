<?php

namespace App\Http\Requests;

/**
 * @bodyParam first_name string required Customer first name. Example: Ahmed
 * @bodyParam last_name string required Customer last name. Example: Ali
 * @bodyParam mobile string required Must match the regex /^05[0-9]{8}$/. Example: 0501234567
 * @bodyParam email string required The email of the requester. Example: ahmed@example.com
 * @bodyParam address string required The address of the requester. Example: شارع النصر، حي النصر، مدينة الرياض
 * @bodyParam goal_id integer required The id of an existing record in the categories table. Example: 13
 * @bodyParam notes string required Additional information. Example: يرجى التواصل معي في أقرب وقت ممكن
 * @bodyParam type_id integer required The id of an existing record in the categories table. Example: 40
 * @bodyParam real_estate_details string More details about the property. Example: يحتوي على 3 غرف نوم وصالة ومطبخ وحمامين
 * @bodyParam entity_id integer The id of an existing record in the categories table. Example: 35
 * @bodyParam real_estate_age integer required The age of the property. Example: 5
 * @bodyParam real_estate_area integer required The area of the property in square meters. Example: 200
 * @bodyParam usage_id integer The id of an existing record in the categories table. Example: 24
 * @bodyParam latitude numeric Between -90 and 90. Example: 24.7136
 * @bodyParam longitude numeric Between -180 and 180. Example: 46.6753
 * @bodyParam estate_city string required Property city. Example: الرياض
 * @bodyParam estate_region string required Property region. Example: حي النصر
 * @bodyParam estate_line_1 string required Property address line 1. Example: شارع النصر
 * @bodyParam estate_line_2 string Property address line 2. Example: مبنى 123
 * @bodyParam price_package_id integer required The selected price package ID. Example: 1
 * @bodyParam source string The source of the request. Must be either 'website' or 'app'. Defaults to 'website'. Example: website
 */
class CreateRateRequestRequest extends Request
{
    public function rules()
    {
        return [
            // 'name' => 'prohibited', // Legacy
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
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
            // 'location' => 'prohibited', // Legacy
            'estate_city' => 'required|string|max:255',
            'estate_region' => 'required|string|max:255',
            'estate_line_1' => 'required|string|max:255',
            'estate_line_2' => 'nullable|string|max:255',
            'price_package_id' => 'required|exists:price_packages,id',
            'source' => 'nullable|string|in:website,app',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'مطلوب',
            'first_name.max' => '255 حرف كحد أقصى',
            'last_name.required' => 'مطلوب',
            'last_name.max' => '255 حرف كحد أقصى',
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
            'location.max' => '255 حرف كحد أقصى',
            'estate_city.required' => 'مطلوب',
            'estate_city.max' => '255 حرف كحد أقصى',
            'estate_region.required' => 'مطلوب',
            'estate_region.max' => '255 حرف كحد أقصى',
            'estate_line_1.required' => 'مطلوب',
            'estate_line_1.max' => '255 حرف كحد أقصى',
            'estate_line_2.max' => '255 حرف كحد أقصى',
            'source.in' => 'يجب أن يكون إما website أو app',
        ];
    }
}
