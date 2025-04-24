<?php

namespace App\Filament\Resources\CustomAdditionalResource\Pages;

use App\Filament\Resources\CustomAdditionalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomAdditional extends EditRecord
{
    protected static string $resource = CustomAdditionalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
