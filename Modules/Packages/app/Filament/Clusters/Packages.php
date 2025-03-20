<?php

namespace Modules\Packages\Filament\Clusters;

use Filament\Clusters\Cluster;
use Nwidart\Modules\Facades\Module;

class Packages extends Cluster
{
    public static function getModuleName(): string
    {
        return 'Packages';
    }

    public static function getModule(): \Nwidart\Modules\Module
    {
        return Module::findOrFail(static::getModuleName());
    }

    public static function getNavigationLabel(): string
    {
        return __('Packages');
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-briefcase';
    }
}
