<?php

namespace App\Filament\Resources\CustomFlowerResource\Pages;

use App\Filament\Resources\CustomFlowerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomFlowers extends ListRecords
{
    protected static string $resource = CustomFlowerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
