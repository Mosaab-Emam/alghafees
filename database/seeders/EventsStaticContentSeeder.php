<?php

namespace Database\Seeders;

use App\Models\EventsStaticContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventsStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventsStaticContent::create([
            'small_top_title' => 'الفعاليات',
            'main_top_title' => 'أحدث الفعاليات',
            'video_url' => 'https://youtu.be/ddG52erTf4A?si=AhWg47WSCFWc9YPA',
            'events_title' => 'كن جزءًا من أحداثناوفعالياتنا واستفد من فرص لا تُفوّت',
            'events_empty_text' => 'ما من فعاليات في الوقت الحالي',
        ]);
    }
}
