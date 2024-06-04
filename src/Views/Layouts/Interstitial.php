<?php

namespace Devinci\Bladekit\Views\Layouts;

use Illuminate\View\Component;

class Interstitial extends Component
{
    /**
     * The title of the interstitial page.
     *
     * @var string
     */
    public $title;

    /**
     * The header content for the interstitial.
     *
     * @var string|null
     */
    public $header;

    /**
     * The footer content for the interstitial.
     *
     * @var string|null
     */
    public $footer;

    /**
     * Create a new class instance.
     *
     * @param  string  $title
     * @param  string|null  $header
     * @param  string|null  $footer
     * @return void
     */
    public function __construct($title = '', $header = null, $footer = null)
    {
        $this->title = $title;
        $this->header = $header;
        $this->footer = $footer;
    }

    public function render()
    {
        return view('bladekit-layouts::interstitial');
    }
}
