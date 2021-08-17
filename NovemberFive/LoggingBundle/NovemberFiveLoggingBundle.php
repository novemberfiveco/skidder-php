<?php
/**
 * This file is part of LoggingBundle.
 *
 * (c) 2016 November Five BVBA
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NovemberFive\LoggingBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use NovemberFive\LoggingBundle\DependencyInjection\Compiler\NewRelicPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class NovemberFiveLoggingBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new NewRelicPass());
    }
}
