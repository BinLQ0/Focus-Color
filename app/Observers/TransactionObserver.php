<?php

namespace App\Observers;

use App\Models\MaterialRelease;
use App\Models\Product;
use App\Models\ProductResult;

class TransactionObserver
{
    /**
     * Handle the Moved "saving" event.
     *
     * @return void
     */
    public function saving($event)
    {
        if (!($event instanceof ProductResult)) {
            return;
        }

        $product = Product::where('name', request('description'))->first()->id;

        $products = array($product);
        for ($index = 0; $index < count(request('locationID')); $index++) {
            array_push($products, $product);
        }

        request()->merge([
            'pid' => $products,
        ]);
    }

    /**
     * Handle the Moved "saved" event.
     *
     * @return void
     */
    public function saved($event)
    {
        if (!request()->hasAny(['pid', 'amount'])) {
            return;
        }

        $event->products()->sync([]);

        $products   = request('pid');
        $quantity   = request('amount');
        $locations  = request('locationID');

        for ($i = 0; $i < count($quantity) - 1; $i++) {
            $event->products()->attach([
                $products[$i] => [
                    'quantity'  => $quantity[$i],
                    'rack_id'   => $locations[$i],
                ]
            ]);
        }
    }

    /**
     * Handle the Moved "saved" event.
     *
     * @return void
     */
    public function deleting($event)
    {
        if ($event instanceof MaterialRelease) {
            if ($event->result) {
                $event->result->delete();
            }
        }

        $event->products()->sync([]);
    }
}
