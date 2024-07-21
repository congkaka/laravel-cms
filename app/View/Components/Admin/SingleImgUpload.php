<?php

namespace App\View\Components\Admin;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class SingleImgUpload extends Component
{
    public $inputName;
    public $inputId;
    public $fillValue;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($inputName, $fillValue = null)
    {
        $this->inputName = $inputName;
        $this->fillValue = $fillValue;
        $this->inputId = Str::uuid()->toString();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.single-img-upload');
    }
}
