<?php

namespace App\Filament\Resources\CustomPaperResource\Pages;

use App\Filament\Resources\CustomPaperResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomPaper extends EditRecord
{
    protected static string $resource = CustomPaperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
