<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\AuctionResource;
use App\Filament\Resources\RentalResource;
use App\Models\Auction;
use App\Models\Rental;
use Cheesegrits\FilamentGoogleMaps\Widgets\MapWidget;

class MapPageWidget extends MapWidget
{
    protected static ?string $heading = null;

    protected static ?int $zoom = 7;

    protected static ?string $minHeight = '80vh';

    protected static ?string $maxHeight = null;

    public array $controls = [
        'mapTypeControl' => false,
        'scaleControl' => false,
        'streetViewControl' => false,
        'rotateControl' => false,
        'fullscreenControl' => true,
        'searchBoxControl' => false,
        'zoomControl' => true,
    ];

    protected array $mapConfig = [
        'draggable' => true,
        'center' => [
            'lat' => 24.7136,
            'lng' => 46.6753,
        ],
        'zoom' => 7,
        'fit' => true, // Auto-fit to show all markers
        'gmaps' => '',
        'clustering' => true,
        'mapConfig' => [],
    ];

    protected function getData(): array
    {
        $data = [];

        // Fetch all Auctions with valid coordinates
        $auctions = Auction::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('latitude', '!=', 0)
            ->where('longitude', '!=', 0)
            ->limit(500)
            ->get();

        foreach ($auctions as $auction) {
            $location = $auction->location;

            if ($location['lat'] != 0 && $location['lng'] != 0) {
                $label = '<div style="padding: 8px; min-width: 250px;">';
                $label .= '<strong style="font-size: 14px; display: block; margin-bottom: 6px; color: #d32f2f;">🏛️ ' . __('admin.auctions.singular') . '</strong>';
                $label .= '<div style="font-size: 12px; color: #666; line-height: 1.6;">';

                if ($auction->instrument_number) {
                    $label .= '<div><strong>' . __('admin.auctions.fields.instrument_number') . ':</strong> ' . e($auction->instrument_number) . '</div>';
                }
                if ($auction->type) {
                    $label .= '<div><strong>' . __('admin.auctions.fields.type') . ':</strong> ' . e($auction->type) . '</div>';
                }
                if ($auction->area) {
                    $label .= '<div><strong>' . __('admin.auctions.fields.area') . ':</strong> ' . number_format($auction->area, 2) . ' م²</div>';
                }
                if ($auction->opening_price) {
                    $label .= '<div><strong>' . __('admin.auctions.fields.opening_price') . ':</strong> ' . number_format($auction->opening_price) . ' ريال</div>';
                }
                if ($auction->highest_bid) {
                    $label .= '<div><strong>' . __('admin.auctions.fields.highest_bid') . ':</strong> ' . number_format($auction->highest_bid) . ' ريال</div>';
                }
                if ($auction->date) {
                    $label .= '<div><strong>' . __('admin.auctions.fields.date') . ':</strong> ' . $auction->date->format('Y-m-d') . '</div>';
                }
                if ($auction->notes) {
                    $label .= '<div style="margin-top: 4px;"><strong>' . __('admin.auctions.fields.notes') . ':</strong> ' . e(substr($auction->notes, 0, 100)) . (strlen($auction->notes) > 100 ? '...' : '') . '</div>';
                }

                $label .= '<div><strong>Coordinates:</strong> ' . round($location['lat'], 6) . ', ' . round($location['lng'], 6) . '</div>';

                // Add link to view page in dashboard
                $viewUrl = AuctionResource::getUrl('view', ['record' => $auction]);
                $label .= '<div style="margin-top: 8px;"><a href="' . e($viewUrl) . '" style="color: #1976d2; text-decoration: underline; font-weight: 500;">عرض التفاصيل</a></div>';

                $label .= '</div></div>';

                $data[] = [
                    'location' => $location,
                    'label' => $label,
                    'id' => 'auction-' . $auction->id,
                    'url' => $auction->auction_url,
                    'icon' => [
                        'url' => url('auction.svg'),
                        'type' => 'svg',
                        'scale' => [40, 40],
                    ],
                ];
            }
        }

        // Fetch all Rentals with valid coordinates
        $rentals = Rental::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('latitude', '!=', 0)
            ->where('longitude', '!=', 0)
            ->limit(500)
            ->get();

        foreach ($rentals as $rental) {
            $location = $rental->location;

            if ($location['lat'] != 0 && $location['lng'] != 0) {
                $label = '<div style="padding: 8px; min-width: 250px;">';
                $label .= '<strong style="font-size: 14px; display: block; margin-bottom: 6px; color: #1976d2;">🏠 ' . __('admin.rentals.singular') . '</strong>';
                $label .= '<div style="font-size: 12px; color: #666; line-height: 1.6;">';

                if ($rental->contract_number) {
                    $label .= '<div><strong>' . __('admin.rentals.fields.contract_number') . ':</strong> ' . e($rental->contract_number) . '</div>';
                }
                if ($rental->area) {
                    $label .= '<div><strong>' . __('admin.rentals.fields.area') . ':</strong> ' . number_format($rental->area, 2) . ' م²</div>';
                }
                if ($rental->annual_rent) {
                    $label .= '<div><strong>' . __('admin.rentals.fields.annual_rent') . ':</strong> ' . e($rental->annual_rent) . ' ريال</div>';
                }
                if ($rental->contract_date) {
                    $label .= '<div><strong>' . __('admin.rentals.fields.contract_date') . ':</strong> ' . $rental->contract_date->format('Y-m-d') . '</div>';
                }

                $label .= '<div><strong>Coordinates:</strong> ' . round($location['lat'], 6) . ', ' . round($location['lng'], 6) . '</div>';

                // Add link to view page in dashboard
                $viewUrl = RentalResource::getUrl('view', ['record' => $rental]);
                $label .= '<div style="margin-top: 8px;"><a href="' . e($viewUrl) . '" style="color: #1976d2; text-decoration: underline; font-weight: 500;">عرض التفاصيل</a></div>';

                $label .= '</div></div>';

                $data[] = [
                    'location' => $location,
                    'label' => $label,
                    'id' => 'rental-' . $rental->id,
                    'url' => null,
                    'icon' => [
                        'url' => url('rental.svg'),
                        'type' => 'svg',
                        'scale' => [40, 40],
                    ],
                ];
            }
        }

        return $data;
    }

    protected function getFilters(): ?array
    {
        return null;
    }
}
