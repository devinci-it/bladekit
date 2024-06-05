<?php

namespace Devinci\Bladekit\Views\Components\Stack;

use Devinci\Bladekit\Helpers\PathHelper;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;

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
        $iconPath = asset('vendor/bladekit/images/' . $this->icon);
        if ($this->icon && file_exists($iconPath)) {
            return $iconPath;
        }

        Log::error('Icon not found: ' . $this->icon);
        return null;
    }

    public function render()
    {
        return view('bladekit::components.stack.anchor-row', [
            'icon' => $this->icon,
        ]);
    }
}
