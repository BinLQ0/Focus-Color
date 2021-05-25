<?php

namespace App\View\Components\Tables;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ProductListTable extends Component
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
     * @var Illuminate\Support\Collection 
     */
    public $products;

    /**
     * @var bool 
     */
    public $viewStock;

    /**
     * @var bool 
     */
    public $isAll;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($header = '', $option = null, ?Collection $products, $viewStock = false, $isAll = false)
    {
        //$this->collectProducts();

        $this->header    = $header;
        $this->products  = $this->getOldValue($products);
        $this->viewStock = $viewStock;
        $this->isAll     = $isAll;

        //Setup Option Select Form
        $this->option = Product::TypeOf($option)
            ->orderBy('name')
            ->pluck("name", "id")
            ->toArray();
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

    /**
     * Set value if request validation failed
     */
    public function getOldValue(?Collection $default = null)
    {
        if (!old('product_id') || !old('product_quantity') || !\old('product_location')) {
            return $default;
        }

        $products = collect([]);

        foreach (old('product_id') as $key => $value) {
            if (!$value) {
                continue;
            }

            //Collect data from old value
            $products->put($key, [
                'oldId'     => $value,
                'oldQty'    => old('product_quantity', 0)[$key],
                'oldLoc'    => old('product_location', 0)[$key],
            ]);
        }

        return $products;
    }
}
