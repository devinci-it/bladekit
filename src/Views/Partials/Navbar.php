<?php


namespace Devinci\Bladekit\Views\Partials;

use Illuminate\View\Component;

class Navbar extends Component
{
    public $logoPath;

    public function __construct($logoPath = null)
    {
        $this->logoPath = $logoPath ?? asset('favicon.svg');
    }

    public function render()
    {
        return view('bladekit::partials.navbar');
    }
}