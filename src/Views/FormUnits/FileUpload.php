<?php

namespace Devinci\Bladekit\Views\FormUnits;

use Illuminate\View\Component;

class FileUpload extends Component
{
    public $name;
    public $showPreview;
    public $action; // Destination path for file uploads

    public function __construct($name, $action, $showPreview = false)
    {
        $this->name = $name;
        $this->action = $action;
        $this->showPreview = $showPreview;
    }

    public function render()
    {
        return view('components.file-upload');
    }
}
