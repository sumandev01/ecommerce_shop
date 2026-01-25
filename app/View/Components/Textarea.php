<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public function __construct(
        public string $name,
        public string $label = '',
        public ?string $value = '',
        public string $placeholder = '',
        public bool $required = false,
        public ?string $class = null,
        public ?string $id = null,
        public int $rows = 5,
        public bool $editor = true, // এডিটর হবে কি না
        public int $max = 1000      // ম্যাক্স ওয়ার্ড লিমিট
    )
    {
        $this->id = $id ?? $name;
    }

    public function render(): View|Closure|string
    {
        return view('components.textarea');
    }
}