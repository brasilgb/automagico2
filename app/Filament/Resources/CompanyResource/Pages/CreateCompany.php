<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;


    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Filial criada com sucesso!';
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Filial criada')
            ->body('A filial foi criada com sucesso.');
    }

}
