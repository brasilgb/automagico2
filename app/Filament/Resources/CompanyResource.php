<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $modelLabel = 'Filial';
    protected static ?string $pluralModelLabel = 'Filiais';
    protected static ?string $navigationLabel = 'Filiais';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('organization_id')
                    ->relationship('organization', 'name')
                    ->default(null),
                Forms\Components\TextInput::make('altername')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('corpreason')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cnpj')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('statereg')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subnumber')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cep')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('state')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('neighborhood')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('street')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('number')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('complement')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('telephone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('whatsapp')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\Textarea::make('observation')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('organization.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('altername')
                    ->searchable(),
                Tables\Columns\TextColumn::make('corpreason')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cnpj')
                    ->searchable(),
                Tables\Columns\TextColumn::make('statereg')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subnumber')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cep')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('neighborhood')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('complement')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('whatsapp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
