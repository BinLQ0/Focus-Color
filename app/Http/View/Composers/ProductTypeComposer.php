<?php

namespace App\Http\View\Composers;

use App\Models\ProductType;
use Illuminate\View\View;

class ProductTypeComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('type', ProductType::select('id', 'name')->pluck("name", "id")->toArray());
    }
}
