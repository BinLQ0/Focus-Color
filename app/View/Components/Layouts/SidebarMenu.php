<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class SidebarMenu extends Component
{
    /**
     * Set url to redirect
     * 
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
    public function __construct($label = 'Menu', string $url = '#', string $icon = 'fas fa-circle nav-icon')
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
        return view('components.layouts.sidebar-menu');
    }
}
