<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Company;
use App\Models\User;
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
use Illuminate\Support\Facades\Hash;
use Rawilk\FilamentPasswordInput\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    //Company::all()->pluck('subname', 'subnumber')
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Grid::Make()->schema([
                            Forms\Components\Select::make('organization_id')
                                ->label('Organização')
                                ->relationship('organization', 'name')
                                ->rules(['required'])
                                ->reactive()
                                ->default(null),
                            Forms\Components\Select::make('company_id')
                                ->label('Filial')
                                ->options(fn($get): array => Company::where('organization_id', $get('organization_id') ?? null)->pluck('subname', 'subnumber')->toArray())
                                ->rules(['required'])
                                ->default(null),
                        ])->columns(2),
                        Grid::Make()->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Nome')
                                ->rules(['required'])
                                ->maxLength(255),
                            Forms\Components\TextInput::make('email')
                                ->label('E-mail')
                                ->email()
                                ->rules(['required'])
                                ->maxLength(255),
                        ])->columns(2),
                        Grid::Make()->schema([
                            Password::make('password')
                                ->label('Senha')
                                ->password()
                                ->confirmed()
                                ->rules(['min:8'])
                                ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                ->dehydrated(fn($state) => filled($state))
                                ->required(fn(string $context): bool => $context === 'create'),
                            Password::make('password_confirmation')
                                ->label('Repita a senha')
                                ->password()
                                ->required(fn(string $context): bool => $context === 'create')
                                ->dehydrated(false)
                                ->rules(['min:8']),
                            Forms\Components\Select::make('roles')
                                ->options([
                                    '0' => 'Administrador de filial',
                                    '1' => 'Administrador de Organização'
                                ])
                                ->label('Permissções de filiais')
                                ->default(null),
                        ])->columns(3),
                        Grid::Make()->schema([
                            Forms\Components\Toggle::make('is_admin')
                                ->label('Administrador de aplicação'),
                            Forms\Components\Toggle::make('status'),
                        ])->columns(2)
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
                Tables\Columns\TextColumn::make('company.subname')
                    ->label('Filial')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_admin')
                    ->label('Adm/App')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles')
                    ->label('Permissões')
                    ->formatStateUsing(fn(string $state) => $state === '0' ? 'Admin/filial' : 'Admin/aplicação')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criação')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Usuário deletado')
                            ->body('O usuário foi deletado com sucesso.')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
