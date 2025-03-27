<?php

namespace Modules\Packages\Filament\Clusters\Packages\Resources;

use Modules\Packages\Filament\Clusters\Packages;
use Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource\Pages;
use Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource\RelationManagers;
use Modules\Packages\Models\Package;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $cluster = Packages::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Package Details')
                        ->schema([
                            TextInput::make('name')
                                ->label('Package Name')
                                ->required(),

                            SpatieMediaLibraryFileUpload::make('images')
                                ->label('Package Images')
                                ->multiple()
                                ->image()
                                // ->disk('packages')
                                // ->collection('packages')
                                // ->directory('packages')
                                ,

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
                        ]),
                    Step::make('Prices')
                        ->schema([
                            Repeater::make('price')
                                ->relationship('price')
                                ->schema([
                                    TextInput::make('number_of_people')
                                        ->label('Number of People')
                                        ->required()
                                        ->numeric()
                                        ->minValue(1),

                                    TextInput::make('price')
                                        ->label('Price')
                                        ->required()
                                        ->numeric(),
                                ]),
                        ]),
                ])->columnSpanFull()
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

                SpatieMediaLibraryImageColumn::make('images')
                    ->label('Images'),
                // TextColumn::make('price1')
                //     ->label('Price 1')
                //     ->money('usd')
                //     ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //     Filter::make('destination')
                //     ->form([
                //         TextInput::make('destination')
                //             ->label('Destination'),
                //     ])
                //     ->query(function ($query, array $data) {
                //         if ($data['destination']) {
                //             $query->where('destination', 'like', "%{$data['destination']}%");
                //         }
                //     }),
                // Filter::make('price_range')
                //     ->form([
                //         TextInput::make('min_price')
                //             ->label('Min Price')
                //             ->numeric(),
                //         TextInput::make('max_price')
                //             ->label('Max Price')
                //             ->numeric(),
                //     ])
                //     ->query(function ($query, array $data) {
                //         if ($data['min_price']) {
                //             $query->where('price1', '>=', $data['min_price']);
                //         }
                //         if ($data['max_price']) {
                //             $query->where('price1', '<=', $data['max_price']);
                //         }
                //     }),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
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
