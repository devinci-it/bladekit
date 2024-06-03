<?php

namespace Devinci\Bladekit\View\Partials;

use Illuminate\View\Component;

class Footer extends Component
{
    public $socialLinks;
    public $footerLinks;

    public function __construct($socialLinks, $footerLinks)
    {
        $this->socialLinks = $socialLinks;
        $this->footerLinks = $footerLinks;
    }

    public function render()
    {
        return view('bladekit::partials.footer');
    }
}
