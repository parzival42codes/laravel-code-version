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

        $versions = config('code-version.version');
        $path = config('code-version.path');

        $this->write(Info::class, 'Can for main versions '.var_export($versions, true).' in: '.$path);

        $consoleTable = [];
        $codeData = new CodeVersionScan($versions, $path);
        foreach ($codeData->getArray() as $code) {
            if ($code['version']) {
                foreach ($code['version'] as $codeKey => $codeVersion) {
                    $consoleTablePrepare['discover'] = $code['discover'];
                    $consoleTablePrepare['key'] = $codeKey;
                    $consoleTablePrepare['version'] = $code['version'][$codeKey];

                    if ($code['versionCompare'][$codeKey] === -1) {
                        $consoleTablePrepare['versionCompare'] = '<fg=yellow;bg=black>Lower</>';
                    } elseif ($code['versionCompare'][$codeKey] === 0) {
                        $consoleTablePrepare['versionCompare'] = '<fg=green;bg=black>Equal</>';
                    } elseif ($code['versionCompare'][$codeKey] === 1) {
                        $consoleTablePrepare['versionCompare'] = '<fg=red;bg=black>Higher</>';
                    }

                    $consoleTablePrepare['note'] = $code['note'][$codeKey] ?? '';

                    d($consoleTablePrepare);

                    $consoleTable[] = $consoleTablePrepare;
                }
            } else {
                $consoleTable[] = [
                    $code['discover'],
                    '',
                    '',
                    '<fg=red;bg=black>No Data</>',
                    '',
                ];
            }
        }

        $this->table(
            ['Class', '', 'Version', 'Version Compare', 'Note'],
            $consoleTable
        );

        return 0;
    }
}
