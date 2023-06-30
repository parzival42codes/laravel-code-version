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
        /** @var array $path */
        $path = config('code-version.scan_path');
        /** @var array $class */
        $class = config('code-version.scan_class');

        $codeService = new CodeVersionScan($versions, $class, $path);
        $codeData = $codeService->getArray();

        return view('code-version::dashboard', compact('codeData'));
    }
}
