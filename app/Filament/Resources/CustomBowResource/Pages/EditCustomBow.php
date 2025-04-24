<?php

namespace App\Filament\Resources\CustomBowResource\Pages;

use App\Filament\Resources\CustomBowResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomBow extends EditRecord
{
    protected static string $resource = CustomBowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
