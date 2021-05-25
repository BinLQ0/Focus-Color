<?php

namespace App\Http\View\Composers;

use App\Models\MaterialRelease;
use Illuminate\View\View;

class UnfinishedWorkComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('open_work', MaterialRelease::doesntHave('result')->pluck("for", "id")->toArray());
    }
}
