<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageUpload extends Component
{
    public string $inputId;

    public function __construct(
        public string $name = 'image',
        public bool $required = false,
        public string $accept = 'image/*',
        public string $class = '',
    ) {
        $this->inputId = 'image-upload-' . uniqid();
    }

    public function render(): View|Closure|string
    {
        return view('components.image-upload');
    }
}
