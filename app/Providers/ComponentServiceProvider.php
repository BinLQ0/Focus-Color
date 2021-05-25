<?php

namespace App\Providers;

use App\View\Components\Forms\Button;
use App\View\Components\Forms\CheckBox;
use App\View\Components\Forms\Date;
use App\View\Components\Forms\Input;
use App\View\Components\Forms\Select;
use App\View\Components\Forms\TextArea;
use App\View\Components\Layouts\Card;
use App\View\Components\Layouts\SidebarMenu;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('button', Button::class);
        Blade::component('checkbox', CheckBox::class);
        Blade::component('date', Date::class);
        Blade::component('card', Card::class);
        Blade::component('input', Input::class);
        Blade::component('select', Select::class);
        Blade::component('sidebar-menu', SidebarMenu::class);
        Blade::component('textarea', TextArea::class);
    }
}
