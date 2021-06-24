<?php

namespace App\View\Components\Forms;

use Illuminate\Support\Str;

class Select extends InputGroupComponent
{
    /**
     * Add Select2 plugin to this field.
     * @var mixed
     */
    public $select2;

    /**
     * This adjective indicates that 
     * something has been chosen or picked out from a larger number;
     * the reason for the selection is usually made clear by the context.
     * @var string|array
     */
    public $selected;

    /**
     * The placeholder attribute specifies a short hint that describes the 
     * expected value of an input field.
     * @var string|array
     */
    public $placeholder;

    /**
     * Represent menu items in popups and other lists of items
     * @var string
     */
    public $option;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $option = [], $placeholder = null, $selected = null, $label = null, $icon = null, $fgroupClass = null, $igroupClass = null, $bind = null, $select2 = null)
    {
        parent::__construct($name, $label, $icon, $fgroupClass, $igroupClass, $bind);

        // Remove if name attribute contains array
        $name = Str::before($name, '[');


        $this->placeholder  = $placeholder;
        $this->selected     = $selected ?? $bind->$name ?? null;
        $this->option       = $option;

        // Check if selected is array, if not convert to array
        if (!is_array($this->selected)) {
            $this->selected = array($this->selected);
        }


        $this->set_select2($select2);
    }

    /**
     * Setup Date Range Picker
     * 
     * @return void
     */
    private function set_select2($value)
    {
        $this->select2 = $value;
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
        return view('components.forms.select');
    }
}
