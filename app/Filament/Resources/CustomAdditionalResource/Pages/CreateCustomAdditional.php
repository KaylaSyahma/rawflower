<?php

namespace App\Filament\Resources\CustomAdditionalResource\Pages;

use App\Filament\Resources\CustomAdditionalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomAdditional extends CreateRecord
{
    protected static string $resource = CustomAdditionalResource::class;
}
