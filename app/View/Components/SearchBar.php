<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchBar extends Component
{
    public $route;
    public $placeholder;

    public function __construct($route, $placeholder = 'Cari data...')
    {
        $this->route = $route;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.search-bar');
    }
}
