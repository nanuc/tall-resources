<?php

namespace Nanuc\TallResources\Resources\Fields;

use Mediconesystems\LivewireDatatables\Column;
use Tanthammar\TallForms\Textarea;

class Text extends BaseField
{
    protected $tallFormClass = Textarea::class;
    protected $tableClass = Column::class;
}
