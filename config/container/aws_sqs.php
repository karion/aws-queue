<?php

use karion\AwsQueue\Service\QueueManipulationService;
use League\Container\Argument\RawArgument;

/** @var $container League\Container\Container */


$container
    ->add('SqsCredentials', \Aws\Credentials\Credentials::class, true)
    ->addArgument(new RawArgument($container->get('config')['aws']['sqs']['key']))
    ->addArgument(new RawArgument($container->get('config')['aws']['sqs']['secret']))
;

$container
    ->add(\Aws\Sqs\SqsClient::class,\Aws\Sqs\SqsClient::class, true)
    ->addArgument(new RawArgument([
        'version'     => 'latest',
        'region'      => 'eu-west-1',
        'credentials' => [
            'key'    => $container->get('config')['aws']['sqs']['key'],
            'secret' => $container->get('config')['aws']['sqs']['secret']
        ]
    ]))
;

$container
    ->add(QueueManipulationService::class, QueueManipulationService::class, true)
    ->addArgument(\Aws\Sqs\SqsClient::class)

;
