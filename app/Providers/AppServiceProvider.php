<?php
namespace App\Providers;

use App\Services\CartService;
use App\Services\OrderService;
use App\Services\VehicleService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CartService::class);
        $this->app->singleton(VehicleService::class);
        $this->app->singleton(OrderService::class, function ($app) {
            return new OrderService($app->make(CartService::class));
        });
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            if (app()->runningInConsole()) return;

            try {
                $view->with('globalCategories',
                    \App\Models\Category::root()->active()
                        ->with(['children' => fn($q) => $q->active()->orderBy('sort_order')])
                        ->orderBy('sort_order')->get()
                );
                $view->with('globalMakes', \App\Models\Make::active()->get());

                $cartService    = app(CartService::class);
                $vehicleService = app(VehicleService::class);
                $view->with('cartCount',      $cartService->getCount());
                $view->with('selectedEngine', $vehicleService->getSelectedEngine());
            } catch (\Exception $e) {
                $view->with('globalCategories', collect());
                $view->with('globalMakes',      collect());
                $view->with('cartCount',        0);
                $view->with('selectedEngine',   null);
            }
        });
    }
}
