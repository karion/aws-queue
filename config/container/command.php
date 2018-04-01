<?php

/** @var $container League\Container\Container */

use karion\AwsQueue\CliCommand\AwsSqsCreateQueueCommand;
use karion\AwsQueue\CliCommand\AwsSqsQueueListCommand;
use karion\AwsQueue\Service\QueueManipulationService;

$container
    ->add(AwsSqsQueueListCommand::class)
    ->addArgument(QueueManipulationService::class)
;

$container
    ->add(AwsSqsCreateQueueCommand::class)
    ->addArgument(QueueManipulationService::class)
;