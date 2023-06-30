<?php

namespace parzival42codes\LaravelCodeVersion;

use parzival42codes\LaravelCodeVersion\App\Commands\LaravelCodeVersionScan;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelCodeVersionServiceProvider extends PackageServiceProvider
{
    public const PACKAGE_NAME = 'laravel-code-version';

    public const PACKAGE_NAME_SHORT = 'code-version';

    public function configurePackage(Package $package): void
    {
        $package->name(self::PACKAGE_NAME)->hasCommand(LaravelCodeVersionScan::class)->hasConfigFile()->hasRoute('route')->hasViews();
    }

    public function registeringPackage(): void
    {
    }
}
