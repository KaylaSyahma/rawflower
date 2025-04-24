<?php

namespace App\Filament\Resources\CustomPaperResource\Pages;

use App\Filament\Resources\CustomPaperResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomPaper extends CreateRecord
{
    protected static string $resource = CustomPaperResource::class;
}
