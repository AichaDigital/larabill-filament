<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament\Resources\ArticleResource\Pages;

use AichaDigital\LarabillFilament\Resources\ArticleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\ViewRecord\Concerns\Translatable;

class ViewArticle extends ViewRecord
{
    use Translatable;

    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
