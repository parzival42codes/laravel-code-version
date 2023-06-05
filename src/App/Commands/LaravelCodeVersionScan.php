<?php

namespace parzival42codes\LaravelCodeVersion\App\Commands;

use App\Console\Commands;
use Illuminate\Console\View\Components\Info;
use parzival42codes\LaravelCodeVersion\App\Services\CodeVersionScan;

class LaravelCodeVersionScan extends Commands
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelCodeVersion:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan Versions';

    /**
     * Execute the console command.
     *
     * @return int
     *
     * @throws \ReflectionException
     */
    public function handle(): int
    {
        // php artisan vendor:publish --tag=code-version-config

        $mainVersion = config('code-version.version');
        $path = config('code-version.path');

        $this->write(Info::class, 'Can for main version '.$mainVersion.' in: '.$path);

        $consoleTable = [];
        $codeData = new CodeVersionScan($mainVersion, $path);
        foreach ($codeData->getArray() as $code) {
            $consoleTablePrepare['discover'] = $code['discover'];
            $consoleTablePrepare['version'] = $code['version'];

            $consoleTablePrepare['versionCompare'] = '<fg=red;bg=black>No Data</>';
            if ($code['versionCompare'] === -1) {
                $consoleTablePrepare['versionCompare'] = '<fg=yellow;bg=black>Lower</>';
            } elseif ($code['versionCompare'] === 0) {
                $consoleTablePrepare['versionCompare'] = '<fg=green;bg=black>Equal</>';
            } elseif ($code['versionCompare'] === 1) {
                $consoleTablePrepare['versionCompare'] = '<fg=red;bg=black>Higher</>';
            }

            $consoleTablePrepare['note'] = $code['note'];

            $consoleTable[] = $consoleTablePrepare;
        }

        $this->table(
            ['Class', 'Version', 'Version Compare', 'Note'],
            $consoleTable
        );

        return 0;
    }
}
