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
    }
}
