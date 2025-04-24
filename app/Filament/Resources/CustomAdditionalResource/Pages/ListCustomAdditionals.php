<?php

namespace App\Filament\Resources\CustomAdditionalResource\Pages;

use App\Filament\Resources\CustomAdditionalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomAdditionals extends ListRecords
{
    protected static string $resource = CustomAdditionalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
