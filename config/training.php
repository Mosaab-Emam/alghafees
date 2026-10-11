<?php

return [
    'delivery_method' => env('TRAINING_QUESTIONNAIRE_DELIVERY_METHOD', 'email'),
    'whatsapp_number' => env('TRAINING_QUESTIONNAIRE_WHATSAPP_NUMBER'),
    'recipient' => env('TRAINING_QUESTIONNAIRE_RECIPIENT', 'mosaab.emam123@gmail.com'),
    'from' => [
        'address' => env('TRAINING_QUESTIONNAIRE_MAIL_FROM_ADDRESS', 'taqeem@alghafestaqeem.com'),
        'name' => env('TRAINING_QUESTIONNAIRE_MAIL_FROM_NAME', 'شركة صالح علي الغفيص للتقييم العقاري'),
    ],
    'questions' => [
        'tamheer' => [
            'label' => 'هل سبق لك الالتحاق ببرنامج التدريب (تمهير)؟',
            'options' => ['yes' => 'نعم', 'no' => 'لا'],
        ],
        'commercial_registration' => [
            'label' => 'هل سبق إصدار سجل تجاري باسمك؟',
            'options' => ['yes' => 'نعم', 'no' => 'لا'],
        ],
        'social_insurance' => [
            'label' => 'هل سبق لك العمل لدى جهة حكومية أو خاصة وتسجيلك في التأمينات الاجتماعية؟',
            'options' => ['yes' => 'نعم', 'no' => 'لا'],
        ],
        'marital_status' => [
            'label' => 'ما هي الحالة الاجتماعية؟',
            'options' => [
                'single' => 'أعزب / عزباء',
                'married' => 'متزوج / متزوجة',
                'divorced' => 'مطلق / مطلقة',
                'widowed' => 'أرمل / أرملة',
            ],
        ],
    ],
];
