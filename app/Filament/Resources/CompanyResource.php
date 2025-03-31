<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Cep;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

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
                Section::make()
                    ->schema([
                        Grid::make()->schema([
                            Forms\Components\Select::make('organization_id')
                                ->label('Organização')
                                ->relationship('organization', 'name')
                                ->default(null),
                            Document::make('cnpj')
                                ->label('CNPJ')
                                ->cnpj('99999999/9999-99')
                                ->rules(['required'])
                                ->maxLength(18),
                        ])->columns(2),
                        Grid::make()->schema([
                            Forms\Components\TextInput::make('corpreason')
                                ->label('Razão social')
                                ->rules(['required'])
                                ->maxLength(255),
                            Forms\Components\TextInput::make('subnumber')
                                ->label('Número da filial')
                                ->rules(['required'])
                                ->maxLength(255),
                            Forms\Components\TextInput::make('subname')
                                ->label('Nome filial')
                                ->rules(['required'])
                                ->maxLength(255),
                        ])->columns(3),
                        Grid::make()->schema([
                            Cep::make('cep')
                                ->viaCep(
                                    mode: 'suffix', // Determines whether the action should be appended to (suffix) or prepended to (prefix) the cep field, or not included at all (none).
                                    errorMessage: 'CEP inválido.', // Error message to display if the CEP is invalid.

                                    /**
                                     * Other form fields that can be filled by ViaCep.
                                     * The key is the name of the Filament input, and the value is the ViaCep attribute that corresponds to it.
                                     * More information: https://viacep.com.br/
                                     */
                                    setFields: [
                                        'street' => 'logradouro',
                                        'number' => 'numero',
                                        'complement' => 'complemento',
                                        'district' => 'bairro',
                                        'city' => 'localidade',
                                        'state' => 'uf'
                                    ]
                                )
                                ->label('CEP')
                                ->rules(['required'])
                                ->maxLength(11),
                            Forms\Components\TextInput::make('state')
                                ->label('Estado')
                                ->rules(['required'])
                                ->maxLength(255),
                            Forms\Components\TextInput::make('city')
                                ->label('Cidade')
                                ->rules(['required'])
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\TextInput::make('district')
                                ->label('Bairro')
                                ->rules(['required'])
                                ->maxLength(255),
                        ])->columns(4),
                        Grid::make()->schema([
                            Forms\Components\TextInput::make('street')
                                ->label('Logradouro')
                                ->rules(['required'])
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\TextInput::make('number')
                                ->label('Número')
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\TextInput::make('complement')
                                ->label('Complemento')
                                ->maxLength(255)
                                ->default(null),
                        ])->columns(3),
                        Grid::make()->schema([
                            PhoneNumber::make('telephone')
                                ->label('Telefone')
                                ->rules(['required'])
                                ->maxLength(255),
                            Forms\Components\TextInput::make('whatsapp')
                                ->label('Whatsapp')
                                ->maxLength(20)
                                ->default(null),
                        ])->columns(2),
                        Forms\Components\Textarea::make('observation')
                            ->label('Observações')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('status')
                            ->label('Ativar esta filial'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('organization.name')
                    ->label('Organização')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subnumber')
                    ->label('N° Filial')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('subname')
                    ->label('Nome Filial')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('cnpj')
                    ->label('CNPJ')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone')
                    ->label('Telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Filial editada')
                        ->body('A filial foi editada com sucesso.')
                ),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Filial deletada')
                            ->body('A filial foi deletada com sucesso.')
                    ),
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
