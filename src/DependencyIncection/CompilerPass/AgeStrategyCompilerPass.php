<?php


namespace App\DependencyIncection\CompilerPass;

use App\Service\Context;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class AgeStrategyCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        // Find the definition of our context service
        $contextDefinition = $container->findDefinition('context');

        // Find the definitions of all the strategy services
        $strategyServiceIds = array_keys(
            $container->findTaggedServiceIds('age_strategy')
        );

        // Add an addStrategy call on the context for each strategy
        foreach ($strategyServiceIds as $strategyServiceId) {
            $contextDefinition->addMethodCall(
                'addStrategy',
                [new Reference($strategyServiceId)]
            );
        }
    }
}