<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament\Resources;

use AichaDigital\Larabill\Enums\ItemType;
use AichaDigital\Larabill\Models\Article;
use AichaDigital\LarabillFilament\Resources\ArticleResource\Pages;
use AichaDigital\LarabillFilament\Resources\ArticleResource\RelationManagers\ArticlePricesRelationManager;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

/**
 * ArticleResource
 *
 * Manages articles (products/services) in Filament admin panel.
 * Prices are managed via ArticlePricesRelationManager (one article = multiple prices).
 */
class ArticleResource extends Resource
{
    use Translatable;

    protected static ?string $model = Article::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static string|\UnitEnum|null $navigationGroup = 'Billing';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('larabill-filament::resources.article.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('larabill-filament::resources.article.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('larabill-filament::resources.article.plural_model_label');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('larabill-filament::resources.article.sections.basic_info'))
                    ->schema([
                        TextInput::make('code')
                            ->label(__('larabill-filament::resources.article.fields.code'))
                            ->required()
                            ->maxLength(50)
                            ->unique(ignoreRecord: true),

                        TextInput::make('name')
                            ->label(__('larabill-filament::resources.article.fields.name'))
                            ->required()
                            ->maxLength(255),

                        Select::make('item_type')
                            ->label(__('larabill-filament::resources.article.fields.item_type'))
                            ->helperText(__('larabill-filament::resources.article.fields.item_type_helper'))
                            ->options(collect(ItemType::cases())->mapWithKeys(
                                fn (ItemType $type) => [$type->value => $type->label()]
                            ))
                            ->required()
                            ->native(false),

                        TextInput::make('category')
                            ->label(__('larabill-filament::resources.article.fields.category'))
                            ->maxLength(100),

                        Textarea::make('description')
                            ->label(__('larabill-filament::resources.article.fields.description'))
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make(__('larabill-filament::resources.article.sections.pricing'))
                    ->description(__('larabill-filament::resources.article.sections.pricing_description'))
                    ->schema([
                        TextInput::make('cost_price')
                            ->label(__('larabill-filament::resources.article.fields.cost_price'))
                            ->helperText(__('larabill-filament::resources.article.fields.cost_price_helper'))
                            ->numeric()
                            ->prefix('€')
                            ->step(0.01)
                            ->formatStateUsing(fn (?int $state): ?float => $state !== null ? $state / 100 : null)
                            ->dehydrateStateUsing(fn (?float $state): ?int => $state !== null ? (int) round($state * 100) : null),

                        Select::make('tax_group_id')
                            ->label(__('larabill-filament::resources.article.fields.tax_group'))
                            ->relationship('taxGroup', 'name')
                            ->searchable()
                            ->preload()
                            ->native(false),

                        Select::make('unit_measure_id')
                            ->label(__('larabill-filament::resources.article.fields.unit_measure'))
                            ->relationship('unitMeasure', 'name')
                            ->searchable()
                            ->preload()
                            ->native(false),

                        Toggle::make('is_active')
                            ->label(__('larabill-filament::resources.article.fields.is_active'))
                            ->default(true),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label(__('larabill-filament::resources.article.fields.code'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label(__('larabill-filament::resources.article.fields.name'))
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                TextColumn::make('item_type')
                    ->label(__('larabill-filament::resources.article.fields.item_type'))
                    ->formatStateUsing(fn (ItemType $state): string => $state->label())
                    ->badge()
                    ->sortable(),

                TextColumn::make('category')
                    ->label(__('larabill-filament::resources.article.fields.category'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('prices_count')
                    ->label(__('larabill-filament::resources.article.fields.prices_count'))
                    ->counts('prices')
                    ->badge()
                    ->color('success'),

                TextColumn::make('taxGroup.name')
                    ->label(__('larabill-filament::resources.article.fields.tax_group'))
                    ->sortable()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label(__('larabill-filament::resources.article.fields.is_active'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('larabill-filament::resources.article.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->filters([
                TernaryFilter::make('is_active')
                    ->label(__('larabill-filament::resources.article.fields.is_active')),

                SelectFilter::make('item_type')
                    ->label(__('larabill-filament::resources.article.fields.item_type'))
                    ->options(collect(ItemType::cases())->mapWithKeys(
                        fn (ItemType $type) => [$type->value => $type->label()]
                    )),

                SelectFilter::make('category')
                    ->label(__('larabill-filament::resources.article.fields.category'))
                    ->options(fn () => Article::query()
                        ->whereNotNull('category')
                        ->distinct()
                        ->pluck('category', 'category')
                        ->toArray()
                    ),

                SelectFilter::make('tax_group_id')
                    ->label(__('larabill-filament::resources.article.fields.tax_group'))
                    ->relationship('taxGroup', 'name'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ArticlePricesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
