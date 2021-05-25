<?php

namespace App\Observers;

use App\Models\InitializeStock;
use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        if (!request()->hasAny(['date', 'first_balance'])) {
            return;
        }

        $transaction = InitializeStock::create(['date' => request('date')]);
        $transaction->products()->sync([
            $product->id => [
                'quantity'  => request('first_balance')
            ],
        ]);
    }
}
