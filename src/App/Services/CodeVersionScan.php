<?php

namespace parzival42codes\LaravelCodeVersion\App\Services;

use ReflectionClass;
use ReflectionException;
use Spatie\StructureDiscoverer\Discover;

class CodeVersionScan
{
    private array $codeInfoCollection = [];

    /**
     * @throws ReflectionException
     */
    public function __construct(array $versions, array $configClasses, array $configPaths)
    {
        foreach ($configClasses as $configClass) {
            foreach ($configPaths as $configPath) {
                $discoverClass = Discover::in($configPath)->classes()->extending($configClass)->get();
                /** @var string $discover */
                foreach ($discoverClass as $discover) {
                    $reflectionClass = new ReflectionClass($discover);

                    $docComment = $reflectionClass->getDocComment();

                    if ($docComment) {
                        $codeInfo = [
                            'discover' => $discover,
                            'versionDoc' => false,
                            'version' => [],
                            'note' => null,
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
                                $codeInfo['versionDoc'] = true;
                            }
                        }

                        foreach (array_keys($versions) as $version) {
                            if (! isset($codeInfo['version'][$version])) {
                                $codeInfo['version'][$version] = null;
                                $this->codeInfoCollection[$discover] = $codeInfo;
                            }
                        }

                        if ($codeInfo['version']) {
                            $this->codeInfoCollection[$discover] = $codeInfo;
                        } else {
                            $codeInfo['note'] = null;
                            $codeInfo['version'] = null;
                            $this->codeInfoCollection[$discover] = $codeInfo;
                        }
                    } else {
                        $codeInfo['note'] = null;
                        $codeInfo['version'] = [];
                        $codeInfo['versionDoc'] = false;
                        $codeInfo['discover'] = $discover;
                        $this->codeInfoCollection[$discover] = $codeInfo;
                    }
                }
            }
        }
    }

    public function getArray(): array
    {
        return $this->codeInfoCollection;
    }
}
