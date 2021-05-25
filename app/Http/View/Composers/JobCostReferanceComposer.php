<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class JobCostReferanceComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('referance', array(
            'PRODUCTION' => 'PRODUCTION',
            'DEVELOPMENT' => 'DEVELOPMENT',
            'OTHERS' => 'OTHERS'
        ));
    }
}
