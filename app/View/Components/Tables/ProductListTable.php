<?php

namespace App\View\Components\Tables;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductListTable extends ListTableComponent
{
    /**
     * @var string 
     */
    public $header;

    /**
     * @var string
     * 
     * Option list with 
     * # is_material or
     * # is_goods
     */
    public $option;

    /**
     * Execute when needed product, location or stock
     * 
     * @var Illuminate\Support\Collection
     */
    public $views;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($header = null, $productType = null, ?Collection $products, array $only = [], array $except = [])
    {
        parent::__construct($products);

        $this->header = $header;
        // Setup Function
        $this->setupViews($only, $except);
        $this->setupOption($productType);
    }

    /**
     * 
     */
    private function setupViews($only, $except)
    {
        // Default Setting
        $this->views = collect(['product', 'location', 'quantity', 'stock']);

        if (!empty($only)) {
            
            $this->views = $this->views->filter(function ($value, $key) use ($only){
                return in_array($value, $only);
            });
        }

        if (!empty($except)) {
            $this->views = $this->views->filter(function ($value, $key) use ($except){
                return !in_array($value, $except);
            });
        }
    }

    /**
     * Setup list of products by type
     * 
     * @param string  $type
     * @return void
     */
    private function setupOption($type)
    {
        // Convert to query
        $option = Product::query();

        // Check if want to get Material Product
        $option = $option->when($type === 'material', function ($q) {
            $q->typeOf('is_material');
        });

        // Check if want to get Goods Product
        $option = $option->when($type === 'goods', function ($q) {
            $q->typeOf('is_goods');
        });

        $this->option = $option->orderBy('name')
            ->pluck("name", "id")
            ->toArray();
    }

    /**
     * The function used to check 
     * whether it can be seen or not
     */
    public function canView($value)
    {
        return $this->views->contains($value);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.tables.product-list-table');
    }
}
