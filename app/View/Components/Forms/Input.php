<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
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
    public $icon;

    /**
     * @var string
     */
    public $margin;

    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $form;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = '', $value = '', $margin = 'mb-3', $icon = null, $form = '')
    {
        $this->name     = $name;
        $this->value    = $value;
        $this->icon     = $icon;
        $this->margin   = $margin;
        $this->form     = $form;
        $this->label    = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        switch ($this->form) {
            case 'v':
            case 'vertical':
                return view('components.forms.input-vertical');
                break;
            case 'h':
            case 'horizontal':
                return view('components.forms.input-horizontal');
                break;
            default:
                return view('components.forms.input');
                break;
        }
    }
}
