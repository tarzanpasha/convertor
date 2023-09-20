<?php

namespace App\Providers;


use App\Services\Interfaces\OrganizationDataManipulationServiceInterface;
use App\Services\OrganizationDataManipulationService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(OrganizationDataManipulationServiceInterface::class, OrganizationDataManipulationService::class);
    }
}
