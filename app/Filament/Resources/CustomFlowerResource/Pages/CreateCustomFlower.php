<?php

namespace App\Filament\Resources\CustomFlowerResource\Pages;

use App\Filament\Resources\CustomFlowerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomFlower extends CreateRecord
{
    protected static string $resource = CustomFlowerResource::class;
}
