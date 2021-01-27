## Purpose
Define resources for your models that can then be used in forms and tables. Currently it uses the great packages [tanthammar/tall-forms](https://github.com/tanthammar/tall-forms) for forms and [MedicOneSystems/livewire-datatables](https://github.com/MedicOneSystems/livewire-datatables) for datatables.

## Installation
```
composer require nanuc/tall-resources@dev-master
```

## Usage
### Define a resource
```php
namespace Domain\User\Resources;

use Nanuc\TallResources\Resources\Fields\Email;
use Nanuc\TallResources\Resources\Fields\TextString;
use Nanuc\TallResources\Resources\TallResource;

class UserResource extends TallResource
{
    protected function fields()
    {
        return [
            TextString::make('Name'),
            Email::make('Email'),
        ];
    }
}
```

## Use in form
```php 
public function fields()
{
    return UserResource::asForm();
}
```
Optionally you can define which fields you want to display:
```php 
public function fields()
{
    return UserResource::asForm(['name', 'created_at']);
}
```

## Use in table 
```php 
public function columns()
{
    return UserResource::asTable();
}
```

### Table configuration

#### Actions
You can define actions that will show up as last column of the table.
If there is a route with the action parameter, it will be used - otherwise a Livewire method with the action parameter will be called.
```php 
public function columns()
{
    $tableConfiguration = new TallTableConfiguration(
        viewAction: 'users.view',
        editAction: 'edit',
        deleteAction: 'users.delete',
        actionKey: 'id'  // optional; defaults to 'id'
    );
    return UserResource::asTable($tableConfiguration);
}
```

## Available fields
### TextString
### Email
### Date
### Boolean