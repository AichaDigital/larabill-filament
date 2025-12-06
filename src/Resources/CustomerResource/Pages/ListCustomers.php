<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament\Resources\CustomerResource\Pages;

use AichaDigital\LarabillFilament\Resources\CustomerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
