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
    public function __construct(array $versions, string $path)
    {
        $discoverClass = Discover::in($path)->classes()->extending(Controller::class)->get();

        foreach ($discoverClass as $discover) {
            $reflectionClass = new ReflectionClass($discover);

            $docComment = $reflectionClass->getDocComment();

            if ($docComment) {
                $codeInfo = [
                    'discover' => $discover,
                    'version' => [],
                    'note' => [],
                ];

                preg_match_all('!@code-(.*)-(.*):(.*)!', $docComment, $matches, PREG_SET_ORDER);
                foreach ($matches as $match) {
                    if ($match[1] === 'note') {
                        $codeInfo['note'][$match[2]] = trim($match[3]);
                    }

                    if ($match[1] === 'version') {
                        $codeInfo['version'][$match[2]] = trim($match[3]);
                        $codeInfo['versionCompare'][$match[2]] = version_compare($codeInfo['version'][$match[2]],
                            $versions[$match[2]] ?? '1.0.0');
                    }
                }

                if ($codeInfo['version']) {
                    $this->codeInfoCollection[$discover] = $codeInfo;
                } else {
                    $codeInfo['note'] = null;
                    $codeInfo['version'] = null;
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
