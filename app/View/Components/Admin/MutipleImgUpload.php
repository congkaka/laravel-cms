<?php

namespace App\View\Components\Admin;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class MutipleImgUpload extends Component
{
    public $inputName;
    public $inputId;
    public $fillValues;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($inputName, $fillValues = null)
    {
        $this->inputName = $inputName;
        $this->fillValues = $fillValues;
        $this->inputId = Str::uuid()->toString();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.mutiple-img-upload');
    }
}
