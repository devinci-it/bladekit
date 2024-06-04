<?php
namespace Devinci\Bladekit\View\Widgets;

use Illuminate\View\Component;
use Illuminate\Support\Facades\File;

class CodeSnippet extends Component
{
    public $code;
    public $theme;
    public $commentChar;

    public $file;
    public $isNumbered;

    public function __construct($code = [], $theme = 'light', $file = null, $commentChar = '#',$isNumbered=true)
    {

        $this->theme = $theme;
        $this->file = $file;
        $this->commentChar = $commentChar;
        $this->isNumbered = $isNumbered;


        if ($file && File::exists($file)) {
            $this->code = File::get($file);
        } else {
            $this->code = $code;
        }

        $holder = [];
        foreach ($this->code as $line) {
            if (is_string($line)) {
                $holder[] = preg_split('/\r\n|\r|\n/', $line);
            } else {
                $holder[] = $line;
            }
        }

        $this->code = array_merge(...$holder);
    }

    public function render()
    {
        return view('bladekit::widgets.code-snippet');
    }
}
