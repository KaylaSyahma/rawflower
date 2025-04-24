<?php

namespace App\Filament\Resources\CustomBowResource\Pages;

use App\Filament\Resources\CustomBowResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomBows extends ListRecords
{
    protected static string $resource = CustomBowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
