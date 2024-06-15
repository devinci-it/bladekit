<?php

namespace Devinci\Bladekit\Views\UiCore;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $header;
    public $footer;
    public $link;
    public $linkText;
    public $size;
    public $theme;
    public $customColor;

    /**
     * Create a new component instance.
     *
     * @param string $title The title of the card.
     * @param string $header The header content of the card.
     * @param string $footer The footer content of the card.
     * @param string $link The URL the card links to.
     * @param string $linkText The text for the link.
     * @param string $size The size of the card: 'small', 'medium', 'large'.
     * @param string $theme The theme of the card: 'light', 'dark'.
     * @param string $customColor The custom background color of the card.
     */
    public function __construct($title = null, $header = null, $footer = null, $link = null, $linkText = null, $size = 'medium', $theme = 'light', $customColor = null)
    {
        $this->title = $title;
        $this->header = $header;
        $this->footer = $footer;
        $this->link = $link;
        $this->linkText = $linkText;
        $this->size = $size;
        $this->theme = $theme;
        $this->customColor = $customColor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('bladekit::uicore.card');
    }
}
