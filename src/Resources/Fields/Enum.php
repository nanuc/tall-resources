<?php

namespace Nanuc\TallResources\Resources\Fields;

use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Nanuc\TallResources\Resources\Traits\HasOptions;
use Tanthammar\TallForms\Input;
use Tanthammar\TallForms\Select;
use Tanthammar\TallFormsSponsors\DatePicker;

class Enum extends BaseField
{
    use HasOptions;
    
    protected $tallFormClass = Select::class;
    // protected $tableClass = DateColumn::class;
    
   // public function
}
