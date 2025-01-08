<?php

namespace NovemberFive\SkidderBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class NewRelicPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $container->setParameter('monolog.handler.newrelic.class', \NovemberFive\SkidderBundle\Handler\SkidderNewRelicHandler::class);
    }

}