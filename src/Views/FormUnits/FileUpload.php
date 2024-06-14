<?php

namespace Devinci\Bladekit\Views\FormUnits;

use Illuminate\View\Component;
class FileUpload extends Component
{
    public $name;
    public $action;
    public $showPreview;
    public $multiple;
    public $acceptedTypes;
    public $maxSize;

    public function __construct(
        string $name,
        string $action,
        bool $showPreview = true,
        bool $multiple = true,
        string $acceptedTypes = '',
        string $maxSize = '10' // Default max size is 10MB
    ) {
        $this->name = $name;
        $this->action = $action;
        $this->showPreview = $showPreview;
        $this->multiple = $multiple;
        $this->acceptedTypes = $acceptedTypes;
        $this->maxSize = $maxSize;
    }

    public function render()
    {
        return view('bladekit::form-units.file-upload');
    }
}
