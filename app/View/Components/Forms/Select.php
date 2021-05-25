<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $option;

    /**
     * @var array
     */
    public $selected;

    /**
     * @var array
     */
    public $label;

    /**
     * @var string
     */
    public $form;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $placeholder;

    /**
     * @var string
     */
    public $placeholderKey;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $form = '', $label = '', $placeholderKey = '', $placeholder = 'Choose ...', $route = null, array $option = [], array $selected = [-1])
    {
        $this->name             = $name;
        $this->option           = $option;
        $this->selected         = old($name) ? [old($name)] : $selected;
        $this->form             = $form;
        $this->label            = $label;
        $this->url              = $route ? route($route) : null;
        $this->placeholder      = $placeholder;
        $this->placeholderKey   = $placeholderKey;
    }

    /**
     * Create a new component instance.
     *
     * @return bool
     */
    public function isSelected($value)
    {
        return in_array($value, $this->selected);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        switch ($this->form) {
            case 'v':
            case 'vertical':
                return view('components.forms.select-vertical');
                break;
            default:
                return view('components.forms.select');
                break;
        }
    }
}
