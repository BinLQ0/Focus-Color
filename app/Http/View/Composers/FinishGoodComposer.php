<?php

namespace App\Http\View\Composers;

use App\Models\Product;
use Illuminate\View\View;

class FinishGoodComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('finish_good', Product::typeOf('is_goods')->orderBy('name')->pluck("name", "id")->toArray());
    }
}
