<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KpisHome extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Users', User::count())
            ->description('New users that ')
            ->descriptionIcon('heroicon-o-users', IconPosition::Before)
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
            Stat::make('New Users', User::count())
            ->description('New users that ')
            ->descriptionIcon('heroicon-o-users', IconPosition::Before)
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('danger'),
            Stat::make('New Users', User::count())
            ->description('New users that ')
            ->descriptionIcon('heroicon-o-users', IconPosition::Before)
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('info'),
            Stat::make('New Users', User::count())
            ->description('New users that ')
            ->descriptionIcon('heroicon-o-users', IconPosition::Before)
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('warning'),
        ];
    }
}
