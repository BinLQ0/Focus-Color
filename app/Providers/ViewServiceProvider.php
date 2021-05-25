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
                'pages.products.create', 'pages.products.edit',
            ],
            ProductTypeComposer::class
        );

        View::composer(
            [
                'pages.material-release.create', 'pages.material-release.edit',
            ],
            FinishGoodComposer::class
        );

        View::composer(
            [
                'pages.product-result.create', 'pages.product-result.edit',
            ],
            UnfinishedWorkComposer::class
        );

        View::composer(
            [
                'pages.job-cost.create', 'pages.job-cost.edit',
            ],
            JobCostReferanceComposer::class
        );

        View::composer(
            [
                'pages.receive-item.create', 'pages.receive-item.edit',
            ],
            SupplierComposer::class
        );

        View::composer(
            [
                'pages.delivery-order.create', 'pages.delivery-order.edit',
            ],
            CustomerComposer::class
        );
    }
}
