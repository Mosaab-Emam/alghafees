<?php

namespace Database\Seeders;

use App\Models\PricePackage;
use Illuminate\Database\Seeder;

class PricePackagesSeeder extends Seeder
{
    public function run(): void
    {
        $price_packages = [
            [
                'title' => "الحزمة الأساسية",
                'description' => "تقييم عقار سكن مساحة اقل عن 1000متر مربع",
                'price' => 1450,
                'icon' => '',
                'perks' => [
                    ['title' => "تقييم عقار سكن مساحة اقل عن 1000متر مربع"],
                    ['title' => "تحليل جودة التربة"],
                    ['title' => "دراسة الموقع الجغرافي"],
                    ['title' => "تقرير بيئي شامل"],
                ],
            ],
            [
                'title' => "الحزمة المتوسطة",
                'description' => "تقييم عقاري تجاري",
                'price' => 2800,
                'icon' => '',
                'perks' => [
                    ['title' => "تقييم العقارات التجارية"],
                    ['title' => "تحليل العائد الاستثماري"],
                    ['title' => "دراسة السوق المحلي"],
                    ['title' => "استشارة مجانية"],
                ],
            ],
            [
                'title' => "الحزمة المتقدمة",
                'description' => "تقييم عقارات زراعية اقل من 50,0000 متر مربع",
                'price' => 6000,
                'icon' => '',
                'perks' => [
                    ['title' => "تقييم الأراضي الزراعية"],
                    ['title' => "تحليل جودة التربة"],
                    ['title' => "دراسة الموقع الجغرافي"],
                    ['title' => "تقرير بيئي شامل"],
                ],
            ],
            [
                'title' => "الحزمة المخصصة",
                'description' => "تقييم عقارات صناعية",
                'price' => 10000,
                'icon' => '',
                'perks' => [
                    ['title' => "تقييم العقارات التجارية"],
                    ['title' => "تحليل العائد الاستثماري"],
                    ['title' => "دراسة السوق المحلي"],
                    ['title' => "استشارة مجانية"],
                ],
            ],
        ];

        foreach ($price_packages as $package) {
            PricePackage::create($package);
        }
    }
}