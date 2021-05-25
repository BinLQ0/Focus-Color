<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TextArea extends Component
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
    public $class;

    /**
     * @var string
     */
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = '', $class = '', $value = '', $form = '')
    {
        $this->name     = $name;
        $this->value    = $value;
        $this->class    = ' ' . $class;
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
                return view('components.forms.textarea-vertical');
                break;
            default:
                return view('components.forms.textarea');
                break;
        }
    }
}
