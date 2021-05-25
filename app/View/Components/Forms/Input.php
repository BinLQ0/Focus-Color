<?php

namespace App\View\Components\Forms;

use App\View\Components\Forms\InputGroupComponent;

class Input extends InputGroupComponent
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = null, $icon = null, $fgroupClass = null, $igroupClass = null)
    {
        parent::__construct($name, $label, $icon, $fgroupClass, $igroupClass);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
