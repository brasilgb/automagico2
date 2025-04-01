<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\Widget;
use Kenepa\MultiWidget\MultiWidget;

class Faturamento extends MultiWidget
{
    protected static string $view = 'filament.app.widgets.faturamento';

    public array $widgets = [
        Resumo::class,
        Associacao::class,
    ];
}
