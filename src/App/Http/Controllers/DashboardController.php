<?php

namespace parzival42codes\LaravelCodeVersion\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use parzival42codes\LaravelCodeVersion\App\Services\CodeVersionScan;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(): Renderable
    {
        /** @var array $versions */
        $versions = config('code-version.versions_required');
        /** @var string $path */
        $path = config('code-version.scan_path');

        $codeService = new CodeVersionScan($versions, $path);
        $codeData = $codeService->getArray();

        d($codeData);

        return view('code-version::dashboard', compact('codeData'));
    }
}
