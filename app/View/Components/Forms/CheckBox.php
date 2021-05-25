<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class CheckBox extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $checked;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, bool $checked = false)
    {
        $this->name     = $name;
        $this->label    = $label;
        $this->checked  = $checked ? 'checked' : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.check-box');
    }
}
