<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('isi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('excerpt')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('published_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Grid::make()
                ->columns(1)
                ->schema([
                    Tables\Columns\Layout\Split::make([
                        // Gambar
                        Tables\Columns\ImageColumn::make('image')
                            ->height('150px') // atau bisa juga pakai angka: '200px'
                            ->width('120px') // atau bisa juga pakai angka: '200px'
                            ->extraImgAttributes([
                                'class' => 'rounded-md object-cover h-full', // Penting: object-cover & h-full biar gambar gak gepeng
                            ])
                            ->grow(false), // Supaya gak ngambil lebar lebih dari seharusnya

                        // Konten
                        Tables\Columns\Layout\Stack::make([
                            Tables\Columns\TextColumn::make('judul')
                                ->weight(FontWeight::Medium)
                                ->size('lg'),

                            Tables\Columns\TextColumn::make('created_at')
                                ->label('Tanggal')
                                ->date('d M Y'),

                            Tables\Columns\TextColumn::make('excerpt')
                                ->limit(50),
                        ])
                    ])
                    ->from('lg') // aktifin Split layout mulai dari ukuran layar lg ke atas
                ])
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
