<?php

namespace Devinci\Bladekit\View\Widgets;
use Illuminate\View\Component;

class PageHeader extends Component
{
    public $sectionHeader;
    public $preText;
    public $sectionSubHeader;
    public $breadCrumb;
    public $icon;
    public $size;
    public $id;

    public function __construct($sectionHeader, $preText = null, $sectionSubHeader = null, $breadCrumb = [], $icon = null, $size = 'default', $id = null)
    {
        $this->sectionHeader = $sectionHeader;
        $this->preText = $preText;
        $this->sectionSubHeader = $sectionSubHeader;
        $this->breadCrumb = $breadCrumb;
        $this->icon = $icon;
        $this->size = $size;
        $this->id = 'page-header-' . uniqid();
    }

    public function render()
    {
        return view('bladekit::widgets.page-header');
    }
}