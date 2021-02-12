<?php

namespace Nanuc\TallResources\Resources\Fields;

use Mediconesystems\LivewireDatatables\Column;
use Tanthammar\TallForms\Input;

class Password extends BaseField
{
    protected $tallFormClass = Input::class;
    protected $tableClass = Column::class;

    public function toFormField()
    {
        return ($this->tallFormClass)::make($this->label, $this->key)
            ->rules($this->rules)
            ->type('password');
    }
}
