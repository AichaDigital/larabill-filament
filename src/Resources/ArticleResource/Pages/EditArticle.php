<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament\Resources\ArticleResource\Pages;

use AichaDigital\LarabillFilament\Resources\ArticleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditArticle extends EditRecord
{
    use Translatable;

    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
