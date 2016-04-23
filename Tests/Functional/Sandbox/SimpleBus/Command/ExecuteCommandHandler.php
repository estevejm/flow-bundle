<?php

namespace EJM\FlowBundle\Tests\Functional\Sandbox\SimpleBus\Command;

use EJM\FlowBundle\Tests\Functional\Sandbox\SimpleBus\Event\CommandExecuted;
use SimpleBus\Message\Recorder\PublicMessageRecorder;

class ExecuteCommandHandler
{
    /**
     * @var PublicMessageRecorder
     */
    private $eventRecorder;

    /**
     * @param PublicMessageRecorder $eventRecorder
     */
    public function __construct(PublicMessageRecorder $eventRecorder)
    {
        $this->eventRecorder = $eventRecorder;
    }

    /**
     * @param ExecuteCommand $command
     */
    public function __invoke(ExecuteCommand $command)
    {
        $this->eventRecorder->record(new CommandExecuted($command->getCreatedAt(), 'done: ' . $command->getMessage()));
    }
}
