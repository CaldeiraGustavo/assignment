<?php

namespace App\Providers;

use App\Adapters\Contracts\ComputersImportInterface;
use App\Adapters\Eloquent\ComputersImportAdapter;
use Illuminate\Support\ServiceProvider;

class AdapterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ComputersImportInterface::class, ComputersImportAdapter::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
