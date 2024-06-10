<?php

namespace Devinci\Bladekit\Views\FormUnits;

use Illuminate\View\Component;

class FileUpload extends Component
{
    public $name;
    public $showPreview;
    public $action; 
    public $multiple; 
    public $acceptedTypes; 

    public function __construct($name, $action, $showPreview = false, $multiple = false, $acceptedTypes = '')
    {
        $this->name = $name;
        $this->action = $action;
        $this->showPreview = $showPreview;
        $this->multiple = $multiple;
        $this->acceptedTypes = $acceptedTypes;
    }

    public function render()
    {
        return view('bladekit::form-units.file-upload');
    }
}
