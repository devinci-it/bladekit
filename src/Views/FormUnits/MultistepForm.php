<?php

namespace Devinci\Bladekit\Views\FormUnits;

use Illuminate\View\Component;
use Closure;
class MultistepForm extends Component
{
    public $action;
    public $steps;

    /**
     * Create a new component instance.
     *
     * @param string $action
     */
    public function __construct()
    {
        $this->action = null;
        $this->steps = collect([]);
    }

    public function addStep($name, Closure $content = null)
    {
        $this->steps->push([
            'name' => $name,
            'content' => $content ? $content() : '',
        ]);
    }

    public function render()
    {
        return view('bladekit::form-units.multistep-form', [
            'action' => $this->action,
            'steps' => $this->steps,
        ]);
    }
}