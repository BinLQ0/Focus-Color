<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * The theme mode (full or outline).
     *
     * @var string
     */
    public $themeMode;

    /**
     * The card theme (light, dark, primary, secondary, info, success,
     * warning, danger or any other AdminLTE color like lighblue or teal).
     *
     * @var string
     */
    public $theme;

    /**
     * Class attribute for the card-body
     *
     * @var string
     */
    public $bodyClass;

    /**
     * Dynamic component to fill body
     *
     * @var string
     */
    public $component;

    /**
     * Card title
     *
     * @var string
     */
    public $title;

    /**
     * Indicates if the card is collapsible.
     *
     * @var mixed
     */
    public $collapsible;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $themeMode = null, $theme = null, $component = null, $bodyClass = null, $collapsible = null)
    {
        $this->themeMode  = $themeMode;
        $this->theme      = $theme;

        /** Card Header */
        $this->title        = $title;
        $this->collapsible  = $collapsible;

        /** Card Body */
        $this->bodyClass  = $bodyClass;
        $this->component  = $component;
    }

    /**
     * Make the class attribute for the card.
     *
     * @return string
     */
    public function makeCardClass()
    {
        $classes = ['card'];

        if (isset($this->theme)) {
            $base = $this->themeMode === 'full' ? 'bg' : 'card';
            $classes[] = "{$base}-{$this->theme}";

            if ($this->themeMode === 'outline') {
                $classes[] = 'card-outline';
            }
        }

        if($this->collapsible === 'collapsed'){
            $classes[] = 'collapsed-card';
        }

        return implode(' ', $classes);
    }

    /**
     * Make the class attribute for the card-body.
     *
     * @return string
     */
    public function makeCardBodyClass()
    {
        $classes = ['card-body'];

        if (isset($this->bodyClass)) {
            $classes[] = $this->bodyClass;
        }

        return implode(' ', $classes);
    }

    /**
     * Check if this card has tools.
     *
     * @return bool
     */
    public function hasTools()
    {
        return isset($this->collapsible);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.card');
    }
}
