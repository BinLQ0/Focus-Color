<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $label;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, string $url = '#', string $icon = null)
    {
        $this->label    = $label;
        $this->icon     = $icon;
        $this->url      = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.button');
    }
}
