<?php

namespace Devinci\Bladekit\Views\FormUnits;

use Illuminate\View\Component;

class FormGroup extends Component
{
    public $name;
    public $label;
    public $type;
    public $value;
    public $required;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $label
     * @param string $type
     * @param string|null $value
     * @param bool $required
     */
    public function __construct($name, $label, $type = 'text', $value = null, $required = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('bladekit::form-units.form-group');
    }
}
