<?php

namespace Devinci\Bladekit\Views\Partials;

use Illuminate\View\Component;

class Header extends Component
{
    public $title;
    public $paginationCssPath;
    public $faviconPath;

    public function __construct($title = null, $paginationCssPath = null, $faviconPath = null)
    {
        $this->title = $title ?? config('bladekit.package_name');
        $this->paginationCssPath = $paginationCssPath ?? asset('vendor/pagination/pagination.css');
        $this->faviconPath = $faviconPath ?? asset('assets/icons/favicon.svg');
    }

    public function render()
    {
        return view('bladekit::partials.header');
    }

}