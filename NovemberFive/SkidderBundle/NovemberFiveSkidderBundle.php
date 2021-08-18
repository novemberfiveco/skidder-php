<?php

namespace SkidderBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Skidder\DependencyInjection\Compiler\NewRelicPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class NovemberFiveSkidderBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new NewRelicPass());
    }
}
