<?php

namespace Skidder\SkidderBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Skidder\SkidderBundle\DependencyInjection\Compiler\NewRelicPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SkidderBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new NewRelicPass());
    }
}