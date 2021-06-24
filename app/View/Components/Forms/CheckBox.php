<?php

namespace App\View\Components\Forms;

class CheckBox extends InputGroupComponent
{
    /**
     * @var bool
     */
    public $checked;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $fgroupClass = null, $checked = null)
    {
        $this->checked  = $checked;
        parent::__construct($name, $label, null, null, $fgroupClass, null, null);
    }

    public function makeCheckClass(){
        $classes = ['icheck-primary'];

        return implode(' ', $classes);
    }

    public function isChecked()
    {
        return $this->checked ? 'checked' : '';
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
