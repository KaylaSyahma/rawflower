<?php

namespace App\Filament\Resources\CategoryFlowerResource\Pages;

use App\Filament\Resources\CategoryFlowerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryFlower extends EditRecord
{
    protected static string $resource = CategoryFlowerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
