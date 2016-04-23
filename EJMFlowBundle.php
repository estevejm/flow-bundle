<?php

namespace EJM\FlowBundle;

use EJM\FlowBundle\DependencyInjection\Compiler\AssemblyStagePass;
use EJM\FlowBundle\DependencyInjection\Compiler\SetCommandHandlerMapPass;
use EJM\FlowBundle\DependencyInjection\Compiler\SetEventSubscriberMapPass;
use EJM\FlowBundle\DependencyInjection\Compiler\ValidatorConstraintPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EJMFlowBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SetCommandHandlerMapPass('command_handler', 'handles'));
        $container->addCompilerPass(new SetEventSubscriberMapPass('event_subscriber', 'subscribes_to'));
        $container->addCompilerPass(new ValidatorConstraintPass());
        $container->addCompilerPass(new AssemblyStagePass());
    }
}
