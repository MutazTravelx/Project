<?php

namespace Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource\Pages;

use Modules\Packages\Filament\Clusters\Packages\Resources\PackageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePackage extends CreateRecord
{
    protected static string $resource = PackageResource::class;
}
