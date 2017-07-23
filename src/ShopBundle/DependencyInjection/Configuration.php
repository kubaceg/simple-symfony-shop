<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('shop');

        $rootNode
            ->children()
            ->scalarNode('currency_code')->defaultValue('USD')->end()
            ->scalarNode('cart_session_key')->defaultValue('cart')->end();

        return $treeBuilder;
    }
}