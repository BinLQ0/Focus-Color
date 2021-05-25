<?php

namespace App\View\Components\Forms;

use App\Models\Product;
use App\Models\Rack;
use Illuminate\View\Component;

class LocationList extends Component
{
    /**
     * @var Int
     */
    public $product_location = -1;

    /**
     * @var String
     */
    public $product_location_text = 'Choose ...';

    /**
     * @var Float
     */
    public $product_quantity = 0;

    /**
     * Create a new component instance.
     * 
     * @return void
     */
    public function __construct($product = null)
    {
        $this->product_location = $product->pivot->rack_id ?? $this->product_location;
        $this->product_quantity = $product->pivot->quantity ?? $this->product_quantity;

        $rack       = Rack::find($this->product_location);
        $rack_name  = $rack ? $rack->code . ' ( ' . $rack->warehouse->name . ' )' : $this->product_location_text;
        $this->product_location_text = $rack_name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.location-list');
    }
}
