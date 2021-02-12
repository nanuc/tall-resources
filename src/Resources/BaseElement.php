<?php

namespace Nanuc\TallResources\Resources;

abstract class BaseElement
{
    public $label;
    public $name;
    public $key;

    protected $rules;
    public $filterable;
    
    public function rules($rules): self
    {
        $this->rules = $rules;
        return $this;
    }

    public function filterable($options = null, $scopeFilter = null)
    {
        $this->filterable = $options ?? true;
        $this->scopeFilter = $scopeFilter;

        return $this;
    }

    public function toFormField()
    {
        $formField = ($this->tallFormClass)::make($this->label, $this->key)
            ->rules($this->rules);

        if(property_exists($this, 'options')) {
            $formField = $formField->options($this->options, false);
        }

        return $formField;
    }

    public function toTableColumn()
    {
        $tableColumn = ($this->getField()->tableClass)::name($this->key)
            ->label($this->label);

        if($this->filterable) {
            $tableColumn = $tableColumn->filterable($this->filterable);
        }

        return $tableColumn;
    }

    abstract protected function getField();
}
