<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SettingsService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(SettingsService $settings)
    {
        view()->share('appSettings', $settings->getAll());
        Paginator::useBootstrapFive();
        Blade::directive('activeRoute', function ($route) {
            return "<?php echo request()->routeIs($route) ? 'active' : ''; ?>";
        });

        if (!function_exists('getContrastColor')) {
            function getContrastColor($hexColor)
            {
                // Remove # if present
                $hexColor = ltrim($hexColor, '#');

                // Convert hex to RGB
                $r = hexdec(substr($hexColor, 0, 2));
                $g = hexdec(substr($hexColor, 2, 2));
                $b = hexdec(substr($hexColor, 4, 2));

                // Calculate luminance
                $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

                // Return black or white based on luminance
                return $luminance > 0.5 ? '#000000' : '#FFFFFF';
            }
        }
    }
}
