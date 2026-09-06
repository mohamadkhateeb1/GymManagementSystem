<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Nav extends Component
{
    public $navGroups;

    public function __construct()
    {
        $this->navGroups = config('nav');
    }

    public function render()
    {
        return view('components.nav');
    }
}