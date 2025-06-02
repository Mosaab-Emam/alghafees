<?php

namespace App\Filament\Resources\TamaraCheckoutSessionResource\Pages;

use App\Filament\Resources\TamaraCheckoutSessionResource;
use App\Models\RateRequest;
use App\Models\TamaraCheckoutSession;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Http;

class CreateTamaraCheckoutSession extends CreateRecord
{
    protected static string $resource = TamaraCheckoutSessionResource::class;

    protected function handleRecordCreation(array $data): TamaraCheckoutSession
    {
        $request = RateRequest::find($data['request_id']);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('TAMARA_API_SANDBOX_TOKEN')
        ])
            ->post('https://api-sandbox.tamara.co/checkout', [
                'total_amount' => [
                    'amount' => $request->price_package->price,
                    'currency' => 'SAR'
                ],
                'shipping_amount' => [
                    'amount' => 0,
                    'currency' => 'SAR'
                ],
                'tax_amount' => [
                    'amount' => 0,
                    'currency' => 'SAR'
                ],
                'order_reference_id' => $request->id,
                'order_number' => $request->request_no,
                'items' => [
                    [
                        'name' => $request->price_package->title,
                        'type' => 'Service',
                        'reference_id' => $request->id,
                        'sku' => 'Price Package - ' . $request->price_package->id,
                        'quantity' => 1,
                        'unit_price' => [
                            'amount' => $request->price_package->price,
                            'currency' => 'SAR'
                        ],
                        'total_amount' => [
                            'amount' => $request->price_package->price,
                            'currency' => 'SAR'
                        ],
                        'tax_amount' => [
                            'amount' => 0,
                            'currency' => 'SAR'
                        ],
                        'discount_amount' => [
                            'amount' => 0,
                            'currency' => 'SAR'
                        ]
                    ]
                ],
                'consumer' => [
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone_number' => $request->mobile
                ],
                'country_code' => 'SA',
                'description' => $request->price_package->description,
                'merchant_url' => [
                    'success' => route('tamara.success'),
                    'failure' => route('tamara.failure'),
                    'cancel' => route('tamara.cancel'),
                    'notification' => route('tamara.notification')
                ],
                'payment_type' => 'PAY_BY_INSTALMENTS',
                'instalments' => 3,
                'shipping_address' => [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'line1' => $request->estate_line_1,
                    'line2' => $request->estate_line_2,
                    'city' => $request->estate_city,
                    'region' => $request->estate_region,
                    'phone_number' => $request->mobile,
                    'country_code' => 'SA'
                ],
                'locale' => 'ar_SA'
            ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to create Tamara checkout session');
        }

        $data['rate_request_id'] = $request->id;
        $data['order_id'] = $response->json()['order_id'];
        $data['checkout_id'] = $response->json()['checkout_id'];
        $data['checkout_url'] = $response->json()['checkout_url'];
        $data['status'] = $response->json()['status'];

        return TamaraCheckoutSession::create($data);
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
