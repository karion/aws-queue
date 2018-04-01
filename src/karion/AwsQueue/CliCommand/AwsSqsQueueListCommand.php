<?php

namespace karion\AwsQueue\CliCommand;


use karion\AwsQueue\Service\QueueManipulationService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AwsSqsQueueListCommand extends Command
{
    /**
     * @var QueueManipulationService
     */
    private $queueManipulationService;

    /**
     * AwsSqsQueueListCommand constructor.
     * @param QueueManipulationService $queueManipulationService
     * @param null $name
     */
    public function __construct(QueueManipulationService $queueManipulationService, $name = null)
    {
        $this->queueManipulationService = $queueManipulationService;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('sqs:queue_list')
            ->setDescription("Get list of queue from AWS SQS service")

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $queueUrls = $this->queueManipulationService->getQueueList();

        $io->title('Queue:');
        $io->listing(array_keys($queueUrls));

        return;
    }

}