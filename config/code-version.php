<?php

use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;

return [

    /*
     * Main Version
     */
    'versions_required' => [
        'php' => '1.0.0',
        'blade' => '1.0.1',
    ],

    /*
     * Path to scan
     */
    'scan_path' => [
        app_path(),
        './packages',
    ],
    /*
     * Path to scan
     */
    'scan_class' => [
        Controller::class,
        AbstractTableConfiguration::class,
    ],

];
