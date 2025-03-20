<?php

namespace Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource\Pages;

use Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPackage extends EditRecord
{
    protected static string $resource = PackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
