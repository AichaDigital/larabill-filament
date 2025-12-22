<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament\Resources\ArticleResource\RelationManagers;

use AichaDigital\Larabill\Enums\BillingFrequency;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

/**
 * ArticlePricesRelationManager
 *
 * Manages the prices for an article with different billing frequencies.
 * Each article can have multiple prices (monthly, quarterly, yearly, etc.)
 */
class ArticlePricesRelationManager extends RelationManager
{
    protected static string $relationship = 'prices';

    protected static ?string $recordTitleAttribute = 'billing_frequency';

    public static function getTitle($ownerRecord, string $pageClass): string
    {
        return __('larabill-filament::resources.article.relations.prices.title');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('billing_frequency')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.billing_frequency'))
                    ->options(collect(BillingFrequency::cases())->mapWithKeys(
                        fn (BillingFrequency $freq) => [$freq->value => $freq->label()]
                    ))
                    ->required()
                    ->native(false)
                    ->columnSpan(1),

                TextInput::make('price')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.price'))
                    ->required()
                    ->numeric()
                    ->prefix('€')
                    ->step(0.01)
                    ->formatStateUsing(fn (?int $state): ?float => $state !== null ? $state / 100 : null)
                    ->dehydrateStateUsing(fn (?float $state): ?int => $state !== null ? (int) round($state * 100) : null)
                    ->columnSpan(1),

                TextInput::make('billing_days_in_advance')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.billing_days_in_advance'))
                    ->numeric()
                    ->default(7)
                    ->minValue(0)
                    ->columnSpan(1),

                Toggle::make('is_active')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.is_active'))
                    ->default(true)
                    ->columnSpan(1),

                DatePicker::make('valid_from')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.valid_from'))
                    ->native(false)
                    ->columnSpan(1),

                DatePicker::make('valid_to')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.valid_to'))
                    ->native(false)
                    ->columnSpan(1),
            ])
            ->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('billing_frequency')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.billing_frequency'))
                    ->formatStateUsing(fn (BillingFrequency $state): string => $state->label())
                    ->badge()
                    ->sortable(),

                TextColumn::make('price')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.price'))
                    ->formatStateUsing(fn (int $state): string => number_format($state / 100, 2, ',', '.').' €')
                    ->sortable(),

                TextColumn::make('billing_days_in_advance')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.billing_days_in_advance'))
                    ->suffix(' días')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.is_active'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('valid_from')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.valid_from'))
                    ->date()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('valid_to')
                    ->label(__('larabill-filament::resources.article.relations.prices.fields.valid_to'))
                    ->date()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('billing_frequency')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
