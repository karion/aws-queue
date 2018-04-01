<?php

namespace karion\AwsQueue\Service;


use Aws\Sqs\SqsClient;

class QueueManipulationService
{
    /**
     * @var SqsClient
     */
    private $sqsClient;


    /**
     * QueueManipulationService constructor.
     * @param SqsClient $sqsClient
     */
    public function __construct(SqsClient $sqsClient)
    {

        $this->sqsClient = $sqsClient;
    }

    public function getQueueList()
    {
        $response = $this->sqsClient->listQueues();

        $queueUrls = $response->get('QueueUrls');

        return array_combine(
            array_map(
                function($url){$parts = explode('/', $url); return end($parts);},
                $queueUrls
            ),
            $queueUrls
        );
    }

    public function createQueue($name)
    {
        $queueUrls = $this->getQueueList();

        if (in_array($name, array_keys($queueUrls))) {
            throw new \InvalidArgumentException("Queue already exist");
        }

        $response = $this->sqsClient->createQueue([
            'QueueName' => $name
        ]);

        return $response->get('QueueUrl');
    }
}