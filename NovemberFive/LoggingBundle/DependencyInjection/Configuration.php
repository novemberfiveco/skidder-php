<?php
/**
 * This file is part of LoggingBundle.
 *
 * (c) 2016 November Five BVBA
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NovemberFive\LoggingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('novemberfive_logging');
        $rootNode
            ->children()
                ->scalarNode('request_id_header')
                    ->info('Configure the header that is used to log a request ID')
                    ->defaultNull()
                ->end()
                ->booleanNode('log_session_token')
                    ->info('Add the session identifier to each line in the log file')
                    ->defaultTrue()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
