<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament\Resources\CustomerResource\Pages;

use AichaDigital\LarabillFilament\Resources\CustomerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}
