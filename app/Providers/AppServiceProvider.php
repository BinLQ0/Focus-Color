<?php

namespace App\Providers;

use App\Models\Adjustment;
use App\Models\DeliveryOrder;
use App\Models\InitializeStock;
use App\Models\JobCost;
use App\Models\MaterialRelease;
use App\Models\Product;
use App\Models\ProductResult;
use App\Models\ReceiveItem;
use App\Observers\ProductObserver;
use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /**
         * Observer
         */
        Product::observe(ProductObserver::class);

        Adjustment::observe(TransactionObserver::class);
        DeliveryOrder::observe(TransactionObserver::class);
        JobCost::observe(TransactionObserver::class);
        MaterialRelease::observe(TransactionObserver::class);
        ProductResult::observe(TransactionObserver::class);
        ReceiveItem::observe(TransactionObserver::class);

        /**
         * Morph Map
         */
        Relation::morphMap([
            'Initialisation'    => InitializeStock::class,
            'Adjustment'        => Adjustment::class,
            'Delivery'          => DeliveryOrder::class,
            'JobCost'           => JobCost::class,
            'Receive'           => ReceiveItem::class,
            'Release'           => MaterialRelease::class,
            'Result'            => ProductResult::class,
        ]);
    }
}
