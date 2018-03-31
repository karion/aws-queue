#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$container =  new \League\Container\Container();

$container->add('config', require __DIR__.'/../config/config.php', true);

$application = new Application();

// ... register commands

$application->run();