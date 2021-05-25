<?php

namespace App\Http\View\Composers;

use App\Models\Relation;
use Illuminate\View\View;

class SupplierComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('supplier', Relation::where('is_supplier', 1)->orderBy('name')->pluck("name", "id")->toArray());
    }
}
