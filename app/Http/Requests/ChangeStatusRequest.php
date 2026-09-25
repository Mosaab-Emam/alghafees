<?php

namespace App\Http\Requests;

class ChangeStatusRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                {
                    return [
                        'status' => 'required|numeric|in:0,1,2,3,4,5,6,7,8,9',
                    ];
                }
                // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'status' => 'required|numeric|in:0,1,2,3,4,5,6,7,8,9',
                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                }
        }
    }

    public function messages()
    {
        return [

        ];
    }
}
