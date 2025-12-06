<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament\Resources\CustomerResource\Pages;

use AichaDigital\LarabillFilament\Resources\CustomerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
