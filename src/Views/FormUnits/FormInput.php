<?php
// app/View/Components/FormInput.php

namespace Devinci\Bladekit\Views\FormUnits;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $label;
    public $name;
    public $type;
    public $value;
    public $placeholder;
    public $required;
    public $hideLabel;
    public $options;

    public $isPassword;
    public $icon;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $name
     * @param string $type
     * @param mixed $value
     * @param string $placeholder
     * @param bool $required
     * @param bool $hideLabel
     * @param array $options
     * @return void
     */
    public function __construct($label, $name, $type = 'text', $value = '', $placeholder = '', $required = false, $hideLabel = false, $options = [], $icon = '',$isPassword=false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->hideLabel = $hideLabel;
        $this->options = $options;
        $this->isPassword=$isPassword;
        $this->icon = $icon;
    }
    
    

    public function render()
    {
        return view('bladekit::form-units.form-input', [
            'label' => $this->label,
            'name' => $this->name,
            'type' => $this->type,
            'value' => $this->value,
            'placeholder' => $this->placeholder,
            'required' => $this->required,
            'hideLabel' => $this->hideLabel,
            'options' => $this->options,
            'icon' => $this->icon,
            'isPassword' => $this->isPassword,
        ]);
    }
}
