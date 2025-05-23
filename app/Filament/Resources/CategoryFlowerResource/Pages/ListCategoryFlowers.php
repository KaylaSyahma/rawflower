<?php

namespace App\Filament\Resources\CategoryFlowerResource\Pages;

use App\Filament\Resources\CategoryFlowerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryFlowers extends ListRecords
{
    protected static string $resource = CategoryFlowerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
