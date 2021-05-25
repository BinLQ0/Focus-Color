<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * @var string
     */
    public $component;

    /**
     * @var string
     */
    public $hasPadding;

    /**
     * @var mixed
     */
    public $params;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($component = null, $hasPadding = false, $params = null)
    {
        $this->component    = $component;
        $this->hasPadding   = $hasPadding;
        $this->params       = $params;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.layouts.card');
    }
}
