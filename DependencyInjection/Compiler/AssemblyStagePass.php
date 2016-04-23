<?php

namespace EJM\FlowBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AssemblyStagePass implements CompilerPassInterface
{
    const FACTORY_SERVICE_ID = 'flow.network.builder';

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(self::FACTORY_SERVICE_ID)) {
            return;
        }

        $definition = $container->findDefinition(self::FACTORY_SERVICE_ID);

        foreach ($container->findTaggedServiceIds('flow.assembly_stage') as $serviceId => $tags) {
            $definition->addMethodCall('withAssemblyStage', [$container->findDefinition($serviceId)]);
        }
    }
}
