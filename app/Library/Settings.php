<?php

namespace App\Library;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Illuminate\Support\Facades\Config;

class Settings
{
    public function compose(
        View $view
    ) {
        $this->setting($view);
    }

    private function setting(View $view)
    {
        /*$setting = Setting::first();*/
        $setting = Cache::remember('settings', 3600, function () {
            return Setting::first();
        });
        $view->with('setting', $setting);

        $view->with('locales', ['ar' => 'Arabic']);
    }
}
