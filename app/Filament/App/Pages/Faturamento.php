<?php

namespace App\Filament\App\Pages;

use App\Filament\App\Widgets\Faturamento as WidgetsFaturamento;
use Filament\Pages\Dashboard as BasePage;

class Faturamento extends BasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.app.pages.faturamento';

    protected function getHeaderWidgets(): array
    {
        return [
            WidgetsFaturamento::class,
        ];
    }
    
}
