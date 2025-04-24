<?php

namespace App\Filament\Resources\CustomFlowerResource\Pages;

use App\Filament\Resources\CustomFlowerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomFlower extends EditRecord
{
    protected static string $resource = CustomFlowerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
