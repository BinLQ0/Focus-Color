<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Date extends Component
{
    /**
     * @var string 
     */
    public $name;

    /**
     * @var string 
     */
    public $class;

    /**
     * @var string 
     */
    public $label;

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
    public function __construct($name, $label = '', $class = '', $value = '', $form = null)
    {
        $this->name  = $name;
        $this->class = $class;
        $this->label = $label;
        $this->value = $value;
        $this->form  = $form;
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
                return view('components.forms.date-vertical');
                break;
            default:
                return view('components.forms.date');
                break;
        }
    }
}
