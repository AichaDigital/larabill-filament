<?php

declare(strict_types=1);

namespace AichaDigital\LarabillFilament\Resources;

use AichaDigital\Larabill\Enums\RelationshipType;
use AichaDigital\Larabill\Models\Customer;
use AichaDigital\Larabill\Models\LegalEntityType;
use AichaDigital\LarabillFilament\Resources\CustomerResource\Pages;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
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

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static string|\UnitEnum|null $navigationGroup = 'Billing';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('larabill-filament::resources.customer.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('larabill-filament::resources.customer.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('larabill-filament::resources.customer.plural_model_label');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('larabill-filament::resources.customer.sections.basic_info'))
                    ->schema([
                        TextInput::make('display_name')
                            ->label(__('larabill-filament::resources.customer.fields.display_name'))
                            ->required()
                            ->maxLength(255),

                        TextInput::make('internal_code')
                            ->label(__('larabill-filament::resources.customer.fields.internal_code'))
                            ->maxLength(50)
                            ->unique(ignoreRecord: true),

                        Select::make('relationship_type')
                            ->label(__('larabill-filament::resources.customer.fields.relationship_type'))
                            ->options(collect(RelationshipType::cases())->mapWithKeys(
                                fn (RelationshipType $type) => [$type->value => $type->label()]
                            ))
                            ->required()
                            ->native(false),

                        Select::make('legal_entity_type_code')
                            ->label(__('larabill-filament::resources.customer.fields.legal_entity_type'))
                            ->relationship('legalEntityType', 'name')
                            ->getOptionLabelFromRecordUsing(fn (LegalEntityType $record): string => $record->formatted_name)
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make(__('larabill-filament::resources.customer.sections.status'))
                    ->schema([
                        Toggle::make('is_active')
                            ->label(__('larabill-filament::resources.customer.fields.is_active'))
                            ->default(true)
                            ->live(),

                        DatePicker::make('inactive_since')
                            ->label(__('larabill-filament::resources.customer.fields.inactive_since'))
                            ->visible(fn ($get) => ! $get('is_active')),

                        TextInput::make('inactive_reason')
                            ->label(__('larabill-filament::resources.customer.fields.inactive_reason'))
                            ->visible(fn ($get) => ! $get('is_active'))
                            ->maxLength(255),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make(__('larabill-filament::resources.customer.sections.notes'))
                    ->schema([
                        Textarea::make('notes')
                            ->label(__('larabill-filament::resources.customer.fields.notes'))
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->collapsed()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('internal_code')
                    ->label(__('larabill-filament::resources.customer.fields.internal_code'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('display_name')
                    ->label(__('larabill-filament::resources.customer.fields.display_name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('relationship_type')
                    ->label(__('larabill-filament::resources.customer.fields.relationship_type'))
                    ->formatStateUsing(fn (RelationshipType $state): string => $state->label())
                    ->badge()
                    ->sortable(),

                TextColumn::make('legalEntityType.name')
                    ->label(__('larabill-filament::resources.customer.fields.legal_entity_type'))
                    ->sortable()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label(__('larabill-filament::resources.customer.fields.is_active'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('larabill-filament::resources.customer.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('display_name')
            ->filters([
                TernaryFilter::make('is_active')
                    ->label(__('larabill-filament::resources.customer.fields.is_active')),

                SelectFilter::make('relationship_type')
                    ->label(__('larabill-filament::resources.customer.fields.relationship_type'))
                    ->options(collect(RelationshipType::cases())->mapWithKeys(
                        fn (RelationshipType $type) => [$type->value => $type->label()]
                    )),

                SelectFilter::make('legal_entity_type_code')
                    ->label(__('larabill-filament::resources.customer.fields.legal_entity_type'))
                    ->relationship('legalEntityType', 'name'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
