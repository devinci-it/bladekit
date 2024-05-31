<?php

namespace Devinci\Bladekit\View\Components\Stack;

use Illuminate\View\Component;

class AnchorRow extends Component
{
    public $icon;
    public $header;
    public $subtitle;
    public $href;
    public $classes;

    public function __construct($href, $header, $subtitle = null, $icon = null, $classes = '')
    {
        $this->href = $href;
        $this->header = $header;
        $this->subtitle = $subtitle;
        $this->icon = $icon;
        $this->classes = $classes;
    }

    public function getSvgIcon()
    {
        if ($this->icon && file_exists(public_path($this->icon))) {
            $svgContent = file_get_contents(public_path($this->icon));
            $svgContent = str_replace('<svg ', '<svg fill="lightgray" ', $svgContent);
            return $svgContent;
        }

        return null;
    }


    public function render()
    {
        return view('bladekit::components.stack.anchor-row', [
            'svgIcon' => $this->getSvgIcon(),
        ]);
    }
}
