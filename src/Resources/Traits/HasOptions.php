<?php

namespace Nanuc\TallResources\Resources\Traits;

trait HasOptions
{
    public $options = [];

    public function options($options)
    {
        $this->options = $options;
        return $this;
    }
}
