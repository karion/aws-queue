<?php

use League\Container\Argument\RawArgument;

/** @var $container League\Container\Container */

$container
    ->add(\Aws\Sqs\SqsClient::class,\Aws\Sqs\SqsClient::class, true)
    ->addArgument('SqsCredentials')
;

$container
    ->add('SqsCredentials', \Aws\Sqs\SqsClient::class, true)
    ->addArgument(new RawArgument($container->get('config')['aws']['sqs']['key']))
    ->addArgument(new RawArgument($container->get('config')['aws']['sqs']['secret']))
;
