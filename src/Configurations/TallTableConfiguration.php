<?php

namespace Nanuc\TallResources\Configurations;

class TallTableConfiguration
{
    public function __construct(
        public ?string $deleteAction = null,
        public ?string $editAction = null,
        public ?string $viewAction = null,
        public string $actionKey = 'id',
    ){}

    public function hasAction()
    {
        return $this->deleteAction || $this->editAction || $this->viewAction;
    }
}
