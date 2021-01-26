<?php

namespace Nanuc\TallResources\Resources;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Nanuc\TallResources\Configurations\TallTableConfiguration;
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

    public static function asTable(TallTableConfiguration $tableConfiguration = null, $fields = null)
    {
        return static::make()->getAsTable($tableConfiguration, $fields);
    }

    public function getAsForm($fields = null)
    {
        return array_map(function($field) {
            return $field->toFormField();
        }, $this->getIncludedFields($fields));
    }

    public function getAsTable(TallTableConfiguration $tableConfiguration = null, $fields = null)
    {
        $fields = array_map(function($field) {
            return $field->toTableColumn();
        }, $this->getIncludedFields($fields));

        if($tableConfiguration->hasAction()) {
            $fields[] = Column::callback([$tableConfiguration->actionKey], function($key) use ($tableConfiguration) {
                return view('tall-resources::actions', [
                    'key' => $key,
                    'tableConfiguration' => $tableConfiguration,
                ]);
            });
        }

        return $fields;
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
