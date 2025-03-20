<?php

namespace Modules\Packages\Filament;

use Coolsam\Modules\Concerns\ModuleFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class PackagesPlugin implements Plugin
{
    use ModuleFilamentPlugin;

    public function getModuleName(): string
    {
        return 'Packages';
    }

    public function getId(): string
    {
        return 'packages';
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
