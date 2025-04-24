<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomFlowerResource\Pages;
use App\Filament\Resources\CustomFlowerResource\RelationManagers;
use App\Models\CustomFlower;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomFlowerResource extends Resource
{
    protected static ?string $navigationGroup = 'Custom Product';
    protected static ?string $model = CustomFlower::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('custom_flowers')
                ->required()
                ->columnspan(2),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('deskripsi')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('harga')
                    ->numeric()
                    ->required(),
    
                Forms\Components\Toggle::make('available')
                    ->label('Tersedia')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('nama'),
                Tables\Columns\TextColumn::make('deskripsi'),
                Tables\Columns\TextColumn::make('harga'),
                Tables\Columns\ToggleColumn::make('available')
            ])
            ->filters([
                //
            ])
            ->actions([
                // ini buat edit
                Tables\Actions\EditAction::make(),
                // ini buat delete
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomFlowers::route('/'),
            'create' => Pages\CreateCustomFlower::route('/create'),
            'edit' => Pages\EditCustomFlower::route('/{record}/edit'),
        ];
    }
}
