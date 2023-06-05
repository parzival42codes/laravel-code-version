<?php

namespace parzival42codes\LaravelCodeVersion\App\Services;

use App\Http\Controllers\Controller;
use ReflectionClass;
use Spatie\StructureDiscoverer\Discover;

class CodeVersionScan
{
    private array $codeInfoCollection = [];

    /**
     * @throws \ReflectionException
     */
    public function __construct(string $mainVersion, string $path)
    {
        $discoverClass = Discover::in($path)->classes()->extending(Controller::class)->get();

        foreach ($discoverClass as $discover) {
            $reflectionClass = new ReflectionClass($discover);

            $docComment = $reflectionClass->getDocComment();

            if ($docComment) {
                $codeInfo = [
                    'discover' => $discover,
                    'version' => '',
                    'versionCompare' => '',
                    'note' => '',
                ];

                preg_match_all('!@code-(.*):(.*)!', $docComment, $matches, PREG_SET_ORDER);
                foreach ($matches as $match) {
                    if ($match[1] === 'version') {
                        $codeInfo['version'] = trim($match[2]);
                    }

                    if ($match[1] === 'note') {
                        $codeInfo['note'] = trim($match[2]);
                    }
                }

                if ($codeInfo['version']) {
                    $codeInfo['versionCompare'] = version_compare($codeInfo['version'], $mainVersion);
                    $this->codeInfoCollection[$discover] = $codeInfo;
                } else {
                    $codeInfo['versionCompare'] = null;
                    $this->codeInfoCollection[$discover] = $codeInfo;
                }
            }
        }
    }

    public function getArray(): array
    {
        return $this->codeInfoCollection;
    }
}
