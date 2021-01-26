<?php

namespace Nanuc\TallResources\Resources\Fields;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Nanuc\TallResources\Resources\BaseElement;
use Tanthammar\TallForms\Input;

abstract class BaseField extends BaseElement
{
    public function __construct($label, $key = null)
    {
        $this->label = $label;
        $this->name = $key ?? Str::snake(Str::lower($label));
        $this->key = $key;
    }

    public static function make(string $label, string $key = null)
    {
        return new static($label, $key);
    }
    
    protected function getField()
    {
        return $this;
    }
}
