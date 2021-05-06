<?php

namespace Nanuc\TallResources\Resources\Fields;

use Tanthammar\TallForms\Input;

class Color extends BaseField
{
    protected $tallFormClass = Input::class;

    public function toFormField()
    {
        return ($this->tallFormClass)::make($this->label, $this->key)
            ->rules($this->rules)
            ->type('color');
    }
}
