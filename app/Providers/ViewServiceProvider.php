<?php

namespace App\Providers;

use App\Http\View\Composers\CustomerComposer;
use App\Http\View\Composers\FinishGoodComposer;
use App\Http\View\Composers\JobCostReferanceComposer;
use App\Http\View\Composers\ProductTypeComposer;
use App\Http\View\Composers\SupplierComposer;
use App\Http\View\Composers\UnfinishedWorkComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                'pages.products.createOrUpdate',
            ],
            ProductTypeComposer::class
        );

        View::composer(
            [
                'pages.modules.manufacture.material-release.createOrUpdate',
            ],
            FinishGoodComposer::class
        );

        View::composer(
            [
                'pages.modules.manufacture.job-cost.createOrUpdate',
            ],
            JobCostReferanceComposer::class
        );

        View::composer(
            [
                'pages.modules.warehouse.receive-item.createOrUpdate',
            ],
            SupplierComposer::class
        );

        View::composer(
            [
                'pages.modules.warehouse.delivery-order.createOrUpdate',
            ],
            CustomerComposer::class
        );
    }
}