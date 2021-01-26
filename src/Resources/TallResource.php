<?php

namespace Nanuc\TallResources\Resources;

use Illuminate\Support\Arr;
use Tanthammar\TallForms\Input;

abstract class TallResource
{
    public static function make()
    {
        return new static;
    }

    public static function asForm($fields = null)
    {
        return static::make()->getAsForm($fields);
    }

    public static function asTable($fields = null)
    {
        return static::make()->getAsTable($fields);
    }

    public function getAsForm($fields = null)
    {
        return array_map(function($field) {
            return $field->toFormField();
        }, $this->getIncludedFields($fields));
    }

    public function getAsTable($fields = null)
    {
        return array_map(function($field) {
            return $field->toTableColumn();
        }, $this->getIncludedFields($fields));
    }

    protected function getIncludedFields($fields)
    {
        if($fields) {
            $includedFields = [];
            $fieldsByName = $this->fieldsByName();
            foreach($fields as $field) {
                $includedFields[] = $fieldsByName[$field];
            }
            return $includedFields;
        }

        return $this->fields();
    }

    protected function fieldsByName()
    {
        return collect($this->fields())->mapWithKeys(fn($field) => [ $field->name => $field]);
    }

    public function getField($name)
    {
        return Arr::get($this->fieldsByName(), $name);
    }

    protected abstract function fields();
}
