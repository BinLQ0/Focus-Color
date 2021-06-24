<?php

namespace App\View\Components\Tables;

use App\Models\Rack;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ListTableComponent extends Component
{
    /**
     * List of Products
     * 
     * @var Illuminate\Support\Collection 
     */
    public $products;

    /**
     * List of Racks
     * 
     * @var Illuminate\Support\Collection 
     */
    public $racks;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?Collection $products)
    {
        $this->products = $products;

        // Create list of racks if product exist
        if (isset($products)) {
            $this->racks = Rack::with(['warehouse'])->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        //
    }
}
