<?php

namespace App\View\Components\Forms;

use App\View\Components\Forms\InputGroupComponent;

class Input extends InputGroupComponent
{
    /**
     * Set element input to be Daterange Picker
     * @var
     */
    public $daterangepicker;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = null, $icon = null, $fgroupClass = null, $igroupClass = null, $bind = null, $daterangepicker = null)
    {
        parent::__construct($name, $label, $icon, $fgroupClass, $igroupClass, $bind);

        $this->set_date_range_picker($daterangepicker);
    }

    /**
     * Setup Date Range Picker
     * 
     * @return void
     */
    private function set_date_range_picker($value)
    {
        $this->daterangepicker = $value;
        
        if (isset($value)) {
            $this->icon = 'far fa-calendar-alt';
        }
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
