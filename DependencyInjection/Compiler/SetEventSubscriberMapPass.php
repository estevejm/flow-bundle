<?php

namespace EJM\FlowBundle\DependencyInjection\Compiler;

use EJM\FlowBundle\DependencyInjection\Compiler\Util\TaggedServicesCollector;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class SetEventSubscriberMapPass implements CompilerPassInterface
{
    const PARAMETER_ID = 'flow.map.events_subscribers';

    use TaggedServicesCollector;

    private $tag;
    private $keyAttribute;

    /**
     * @param string  $tag
     * @param string  $keyAttribute
     */
    public function __construct($tag, $keyAttribute)
    {
        $this->tag = $tag;
        $this->keyAttribute = $keyAttribute;
    }

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $subscribers = [];

        $this->collect(
            $container,
            $this->tag,
            $this->keyAttribute,
            function ($key, $serviceId, Definition $definition) use (&$subscribers)
            {
                $subscribers[$key][] = [
                    'id' => $serviceId,
                    'class' => $definition->getClass()
                ];
            }
        );

        $container->setParameter(self::PARAMETER_ID, $subscribers);
    }
}
