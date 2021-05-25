<?php

namespace App\Http\View\Composers;

use App\Models\Relation;
use Illuminate\View\View;

class CustomerComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('customer', Relation::where('is_customer', 1)->orderBy('name')->pluck("name", "id")->toArray());
    }
}
