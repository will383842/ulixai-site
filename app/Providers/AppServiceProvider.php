<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PaymentService;
use App\Services\ReputationPoinService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentService::class, function ($app) {
            return new PaymentService();
        });

        $this->app->singleton(ReputationPoinService::class, function ($app) {
            return new ReputationPoinService();
        });
    }

    
    public function boot(): void
    {
        $siteName = DB::table('site_settings')->value('site_name'); 

        if (!empty($siteName)) {
            Config::set('app.name', $siteName);
        }

        Blade::directive('site', fn () => "<?php echo e(config('app.name')); ?>");
    }

}
