<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament\Resources\ArticleResource\Pages;

use AichaDigital\LarabillFilament\Resources\ArticleResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateArticle extends CreateRecord
{
    use Translatable;

    protected static string $resource = ArticleResource::class;
}
