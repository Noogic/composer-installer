<?php

namespace Noogic\ComposerInstaller;

use Symfony\Component\Process\Process;

class ComposerInstaller
{
    public function requirePackage(string $package)
    {
        $this->executeCommand($this->findComposer().' require '.$package);
    }

    public function requirePackages(array $packages)
    {
        foreach ($packages as $package) {
            $this->requirePackage($package);
        }
    }

    public function addPrivateRepositories($repositories)
    {
        $projectComposerPath = getcwd().'/composer.json';
        $content = file_get_contents($projectComposerPath);
        $data = json_decode($content, true);

        $repositories = is_array($repositories) ? $repositories : [$repositories];

        foreach ($repositories as $repository) {
            $data['repositories'][] = [
                'type' => 'vcs',
                'url' => $repository,
            ];
        }

        file_put_contents($projectComposerPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    public function update()
    {
        $this->executeCommand($this->findComposer().' update');
    }

    protected function findComposer(): string
    {
        $composerPath = getcwd().'/composer.phar';

        if (file_exists($composerPath)) {
            return '"'.PHP_BINARY.'" '.$composerPath;
        }

        return 'composer';
    }

    private function executeCommand(string $command, string $directory = null, array $options = []): Process
    {
        $directory = $directory ?: getcwd();

        foreach ($options as $option) {
            $command .= ' '.$option;
        }

        $process = Process::fromShellCommandline($command, $directory, null, null, null);
        $process->run();

        return $process;
    }
}
