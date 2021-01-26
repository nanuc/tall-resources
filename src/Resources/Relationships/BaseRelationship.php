<?php

namespace Nanuc\TallResources\Resources\Relationships;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Nanuc\TallResources\Resources\BaseElement;
use Nanuc\TallResources\Resources\TallResource;
use Tanthammar\TallForms\Input;

abstract class BaseRelationship extends BaseElement
{
    public TallResource $resource;

    public function __construct($label, $resource, $key = null)
    {
        $this->label = $label;
        $this->name = $key ?? Str::snake(Str::lower($label));
        $this->key = $key;
        $this->resource = new $resource;
    }

    public static function make(string $label, $resource, string $key = null)
    {
        return new static($label, $resource, $key);
    }

    protected function getField()
    {
        return $this->resource->getField(Arr::last(explode('.', $this->key)));
    }
}
