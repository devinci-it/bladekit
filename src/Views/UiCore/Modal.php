<?php

namespace Devinci\Bladekit\Views\UiCore;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{

    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function showModal()
    {
        echo "<script>window.showModal_{$this->name}();</script>";
    }

    public function hideModal()
    {
        echo "<script>document.getElementById('modalOverlay_{$this->name}').style.display = 'none'; document.body.classList.remove('modal-open');</script>";
    }

    public function shakeModal()
    {
        echo "<script>document.getElementById('modal_{$this->name}').classList.add('shake'); setTimeout(() => { document.getElementById('modal_{$this->name}').classList.remove('shake'); }, 500);</script>";
    }


    /**
     * Get the view / contents that represent the component.
     */

    public function render(): View|Closure|string
    {
        return view('bladekit::uicore.modal');
    }
}
