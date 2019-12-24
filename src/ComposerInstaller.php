<?php

namespace Noogic\ComposerInstaller;

class ComposerInstaller
{
    private $processHandler;
    protected $composer;
    private $path;

    public function __construct(ProcessHandlerInterface $processHandler, string $path)
    {
        $this->processHandler = $processHandler;
        $this->composer = $this->findComposer();
        $this->path = $path;
    }

    public function requirePackages($packages)
    {
        $packages = is_array($packages) ? $packages : [$packages];

        foreach ($packages as $package) {
            $this->processHandler->execute($this->composer.' require '.$package, $this->path);
        }
    }

    public function requireDevPackages($packages)
    {
        $packages = is_array($packages) ? $packages : [$packages];

        foreach ($packages as $package) {
            $this->processHandler->execute($this->composer.' require --dev '.$package, $this->path);
        }
    }

    public function addPrivateRepositories($repositories)
    {
        $config = $this->getComposerConfig();
        $repositories = is_array($repositories) ? $repositories : [$repositories];

        foreach ($repositories as $repository) {
            $config['repositories'][] = [
                'type' => 'vcs',
                'url' => $repository,
            ];
        }

        $this->saveComposerConfig($config);
    }

    public function addPathRepositories($repositories)
    {
        $repositories = is_array($repositories) ? $repositories : [$repositories];
        $config = $this->getComposerConfig();

        foreach ($repositories as $repository) {
            $config['repositories'][] = [
                'type' => 'path',
                'url' => $repository,
                'options' => [
                    'symlink' => true
                ],
            ];
        }

        $this->saveComposerConfig($config);
    }

    public function addConfig($configValues)
    {
        $config = $this->getComposerConfig();
    }

    public function addScripts(string $key, array $value)
    {
        $config = $this->getComposerConfig();
        $newScripts = [$key => $value];

        $scripts = array_merge_recursive($config['scripts'], $newScripts);
        $config['scripts'] = $scripts;

        $this->saveComposerConfig($config);
    }

    public function createDistProject(string $dist)
    {
        $this->processHandler->execute('composer create-project --prefer-dist '.$dist.' .', $this->path);
    }

    protected function findComposer(): string
    {
        $composerPath = getcwd().'/composer.phar';

        if (file_exists($composerPath)) {
            return '"'.PHP_BINARY.'" '.$composerPath;
        }

        return 'composer';
    }

    protected function getComposerConfig(): array
    {
        $projectComposerPath = $this->path.'/composer.json';
        $content = file_get_contents($projectComposerPath);

        return json_decode($content, true);
    }

    protected function saveComposerConfig(array $config)
    {
        $path = $this->path.'/composer.json';
        file_put_contents($path, json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
