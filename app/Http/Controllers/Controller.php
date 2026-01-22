<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\SettingsService;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;

        // Share theme settings with all views
        view()->composer('*', function ($view) use ($settingsService) {
            $view->with([
                'themeSettings' => $settingsService->getThemeSettings(),
                'settingsService' => $settingsService
            ]);
        });
    }
}
