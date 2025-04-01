<?php

namespace App\Filament\App\Widgets;

use App\Models\Association;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class Associacao extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
        ->query(Association::query())
        ->columns([
            Tables\Columns\TextColumn::make('assoc')
                ->label('Associação')
                ->sortable()
                ->searchable(),
        ]);
    }
}
