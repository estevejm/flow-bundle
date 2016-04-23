<?php

namespace EJM\FlowBundle\Tests\Functional\Sandbox\SimpleBus\Subscriber;

use EJM\FlowBundle\Tests\Functional\Sandbox\SimpleBus\Event\CommandExecuted;

class LogCommandExecuted
{
    /**
     * @param CommandExecuted $event
     */
    public function __invoke(CommandExecuted $event)
    {
    }
}
