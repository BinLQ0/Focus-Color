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
     * Execute when needed product, location or stock
     * 
     * @var Illuminate\Support\Collection
     */
    public $views;

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
     * @var App\Models\Product
     */
    public $product;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($option = [], $product = null, $only = [], $racks, $index = 0)
    {
        $this->option      = $option;
        $this->only        = $only;

        // Check if form is create new or edit
        if (!$product) {
            // Show empty List if create new
            return;
        }

        // Set value from old value
        $this->product                = $product;
        $this->product->pid           = old('product_id')[$index] ?? $product->id  ?? $this->product_id;
        $this->product->amount        = old('product_quantity')[$index] ?? $product->pivot->quantity ?? $this->product_quantity;
        $this->product->locationID    = old('product_location')[$index] ?? $product->pivot->rack_id ?? $this->product_location;

        // Check if location has exist
        if ($this->product->locationID <= 0) {
            return;
        }

        // Get Rack Location
        $rack = $racks->where('id', $this->product->locationID)->load(['history' => function ($q) {
            return $q->where('product_id', $this->product->pid);
        }])->first();

        $this->product->locationText    = "{$rack->code} ( {$rack->warehouse->name} )";
        $this->product->stock            = ($this->only) ? $rack->getQuantity($rack->history) : 0;
    }

    public function canView($value)
    {
        return $this->only->contains($value);
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