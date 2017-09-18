<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class SmsSenderTemplateMappingPass
 */
class SmsSenderTemplateMappingPass implements CompilerPassInterface
{

    /**
     * Adds all template mappings to the renderer
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $renderer = $container->getDefinition('Headsnet\Sms\Renderer\Renderer');

        $mappings = $container->findTaggedServiceIds(
            'headsnet_sms.mapping'
        );

        foreach ($mappings as $mapping => $tags)
        {
            $renderer->addMethodCall('addMapping', [new Reference($mapping)]);
        }
    }

}
