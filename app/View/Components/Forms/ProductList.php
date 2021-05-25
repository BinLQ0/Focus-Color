<?php

namespace App\View\Components\Forms;

use App\Models\Rack;
use Illuminate\View\Component;

class ProductList extends Component
{
    /**
     * @var array
     */
    public $option;

    /**
     * @var bool
     */
    public $viewStock;

    /**
     * @var int
     */
    public $product_id = 0;

    /**
     * @var int
     */
    public $product_quantity = 0;

    /**
     * @var int
     */
    public $product_stock = 0;

    /**
     * @var string
     */
    public $product_location = -1;

    /**
     * @var string
     */
    public $product_location_text = 'Choose ...';

    /**
     * @var string
     */
    public $option_rack;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($option = [], $product = null, $viewStock = false, $index = 0)
    {
        $this->option           = $option;
        $this->viewStock        = $viewStock;

        // Check if form is create new or edit
        if (!$product) {
            // Show empty List if create new
            return;
        }

        // Set value from old value
        $this->product_id            = old('product_id')[$index] ?? $product->id  ?? $this->product_id;
        $this->product_quantity      = old('product_quantity')[$index] ?? $product->pivot->quantity ?? $this->product_quantity;
        $this->product_location      = old('product_location')[$index] ?? $product->pivot->rack_id ?? $this->product_location;

        // Check if location has exist
        if ($this->product_location <= 0) {
            return;
        }

        // Get Rack Location
        $rack = Rack::find($this->product_location)
            ->load(['warehouse'])
            ->WithHistoryOfProduct($this->product_id)
            ->first();

        $this->product_location_text    = $rack->full_code;
        $this->product_stock            = ($this->viewStock) ? $rack->getQuantity($rack->history) : 0;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.product-list');
    }
}
