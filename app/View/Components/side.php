<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Side extends Component
{
    public $navGroups;

    public function __construct()
    {
        $this->navGroups = config('side');
    }

    public function render()
    {
        return view('components.side');
    }
}