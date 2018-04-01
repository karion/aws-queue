#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/../vendor/autoload.php';

use karion\AwsQueue\CliCommand\AwsSqsCreateQueueCommand;
use karion\AwsQueue\CliCommand\AwsSqsQueueListCommand;
use Symfony\Component\Console\Application;

$container =  new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer());

$container->add('config', require __DIR__.'/../config/config.php', true);

$dependenciesDir = new DirectoryIterator(__DIR__ . '/../config/container');

foreach (new IteratorIterator($dependenciesDir) as $file) {
    $filename = $file->getFilename();

    if (substr($filename, -4)=== ".php") {
        require($file->getPathname());
    }
}

$application = new Application();

// ... register commands
$application->add($container->get(AwsSqsQueueListCommand::class));
$application->add($container->get(AwsSqsCreateQueueCommand::class));

$application->run();