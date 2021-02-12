<?php

namespace Nanuc\TallResources\Resources;

use Illuminate\Support\Arr;
use Mediconesystems\LivewireDatatables\Column;
use Nanuc\TallResources\Configurations\TallTableConfiguration;
use Nanuc\TallResources\Exceptions\TallResourceException;

abstract class TallResource
{
    public function __construct(
        protected $resource = null
    ){}

    public static function make($resource)
    {
        return new static($resource);
    }

    public static function asForm($fields = null, $resource = null)
    {
        return static::make($resource)->getAsForm($fields);
    }

    public static function asTable(TallTableConfiguration $tableConfiguration = null, $fields = null, $resource = null)
    {
        return static::make($resource)->getAsTable($tableConfiguration, $fields);
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
                if(!Arr::has($fieldsByName, $field)) {
                    throw new TallResourceException('The field "' . $field . '" is not contained in resource ' . $this::class . '.');
                }
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
