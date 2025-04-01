<?php

namespace App\Filament\App\Widgets;

use App\Models\Sale;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class Resumo extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(Sale::query())
            ->columns([
                Tables\Columns\TextColumn::make('descfilial')
                    ->label('Nome Filial')
                    ->sortable()
                    ->searchable(),
            ]);
    }
}
