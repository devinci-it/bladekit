<?php
namespace Devinci\Bladekit\Views\FormUnits;

use Illuminate\View\Component;
class MultiStepForm extends Component
{
    public $titles;
    public $buttonLabels;
    public $responsive;

    public function __construct($titles = [], $buttonLabels = [], $responsive = true)
    {
        $this->titles = $titles;
        $this->buttonLabels = array_merge([
            'prev' => 'Previous',
            'next' => 'Next',
            'submit' => 'Submit',
        ], $buttonLabels);
        $this->responsive = $responsive;
    }

    public function render()
    {
        return view('bladekit::form-units.multi-step-form');
    }
}
