<?php

namespace App\Filament\App\Pages;

use App\Models\Sale;
use Filament\Forms\Components\Builder;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables;

use Filament\Tables\Table;

class Invoicing extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $title = '';

    protected static ?string $navigationLabel = 'Faturamento';
    protected static string $view = 'filament.app.pages.invoicing';

    public static function table(Table $table): Table
    {
        return $table
            ->query(Sale::query())
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('N° OS')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('defect')
                    ->label('Defeito')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('descbudget')
                    ->label('Desc. Orçamento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('valuebudget')
                    ->label('Val. Orçamento'),
                Tables\Columns\TextColumn::make('dtentry')
                    ->label('Entrada')
                    ->dateTime("d/m/Y H:i")
                    ->sortable(),
            ])
            // ->modifyQueryUsing(function (Builder $query) {

            //     return $query->where('status', '<>', 8);
            // })
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make()
            ])
            ->bulkActions([
                //
            ]);
    }
}
