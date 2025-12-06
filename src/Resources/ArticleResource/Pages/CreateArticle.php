<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament\Resources\ArticleResource\Pages;

use AichaDigital\LarabillFilament\Resources\ArticleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
}
