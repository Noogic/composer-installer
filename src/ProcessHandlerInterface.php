<?php

namespace Noogic\ComposerInstaller;

interface ProcessHandlerInterface
{
    public function execute(string $command, string $directory = null, array $options = []);
    public function writeln(string $text);
}
