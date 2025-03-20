<?php

namespace Modules\Packages\Filament\Clusters\Packages\Resources;

use Modules\Packages\Filament\Clusters\Packages;
use Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource\Pages;
use Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource\RelationManagers;
use Modules\Packages\Models\Package;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Packages::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Package')
                    ->description('Create new Package')
                    ->schema([
                        TextInput::make('name')
                            ->label('Package Name')
                            ->required(),

                        FileUpload::make('images')
                            ->label('Package Images')
                            ->multiple()
                            // ->image()
                            ->directory('packages'),

                        Textarea::make('description')
                            ->label('Description')
                            ->required(),

                        TextInput::make('duration')
                            ->label('Duration')
                            ->required(),

                        TextInput::make('destination')
                            ->label('Destination')
                            ->required(),

                        TextInput::make('time')
                            ->label('Time')
                            ->nullable(),

                        TextInput::make('price1')
                            ->label('Price 1')
                            ->numeric()
                            ->required(),

                        TextInput::make('price2')
                            ->label('Price 2')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('price3')
                            ->label('Price 3')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('price4')
                            ->label('Price 4')
                            ->numeric()
                            ->nullable(),

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Package Name')
                ->searchable()
                ->sortable(),
                
            TextColumn::make('destination')
                ->label('Destination')
                ->searchable()
                ->sortable(),
                
            TextColumn::make('duration')
                ->label('Duration')
                ->sortable(),
                
            TextColumn::make('price1')
                ->label('Price 1')
                ->money('usd') // أو استخدم طريقة العرض المناسبة للسعر
                ->sortable(),
                
            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime()
                ->sortable(),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
