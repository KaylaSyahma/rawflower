<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Categori')
                    ->relationship('category', 'name') // 'category' = nama fungsi relasi di model, 'name' = kolom yang ditampilin
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Repeater::make('productImages')
                    ->label('Foto Produk')
                    ->relationship('productImages')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('')
                            ->directory('products')
                            ->image()
                            ->required(),
                    ])
                    ->collapsible()
                    ->defaultItems(1)
                    ->createItemButtonLabel('Tambah Gambar'),
                Forms\Components\CheckboxList::make('colors')
                    ->label('Warna Produk')
                    ->relationship('colors', 'name')
                    ->columns(4)
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('original_price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('popular')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->label('available')
                    ->default(true) 
                    ->required(),
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('productImages.0.image')
                    ->label('Foto')
                    ->size(50),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('colors')
                    ->label('Warna Produk')
                    ->getStateUsing(function ($record) {
                        // Ambil nama warna dari relasi colors
                        $colors = $record->colors->pluck('name');
                        
                        // Gabungkan nama warna dengan koma, kecuali yang terakhir
                        return $colors->implode(function ($name, $key) use ($colors) {
                            return $key === $colors->count() - 1 ? $name : $name . ', '; // Jangan tambahkan koma untuk warna terakhir
                        });
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('original_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('popular')
                    ->boolean(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Available')
                    ->boolean(),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                //ini buat edit
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
