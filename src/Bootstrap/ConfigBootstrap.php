<?php

namespace X3Group\CallTouch\Bootstrap;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use X3Group\CallTouch\Configuration\Repository;
use X3Group\CallTouch\Container;

/**
 * Автозагрузка конфигураций.
 * @author Daniil S.
 */
class ConfigBootstrap
{
    /**
     * Автозагрузка конфигураций.
     * @return void
     */
    public function bootstrap(): void
    {
        $repository = new Repository();
        $files = $this->getFiles();
        array_walk($files, fn($path, $key) => $repository->set($key, @require $path));
        Container::getInstance()->set('Config', $repository);
    }

    /**
     * Получение конфигурационных файлов
     * @return array
     */
    private function getFiles(): array
    {
        $files = [];
        $directory = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'config';

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        /** @var SplFileInfo $spl */
        foreach ($iterator as $spl) {
            if (!$spl->isFile()) {
                continue;
            }

            $directory = $this->getNestedDirectory($spl, $directory);
            $files[$directory . basename($spl->getRealPath(), '.php')] = $spl->getRealPath();
        }

        return $files;
    }

    /**
     * Get the configuration file nesting path.
     *
     * @param SplFileInfo $file
     * @param string $configPath
     * @return string
     */
    private function getNestedDirectory(SplFileInfo $file, string $configPath): string
    {
        $directory = $file->getPath();

        if ($nested = trim(str_replace($configPath, '', $directory), DIRECTORY_SEPARATOR)) {
            $nested = str_replace(DIRECTORY_SEPARATOR, '.', $nested) . '.';
        }

        return $nested;
    }
}