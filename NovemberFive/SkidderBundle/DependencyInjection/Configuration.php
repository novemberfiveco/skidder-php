<?php

namespace NovemberFive\SkidderBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('skidder');
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
