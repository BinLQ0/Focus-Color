<?php

namespace App\View\Components\Tables;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class LocationListTable extends Component
{
    /**
     * @var Collecion
     */
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?Collection $products)
    {
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.tables.location-list-table');
    }
}
