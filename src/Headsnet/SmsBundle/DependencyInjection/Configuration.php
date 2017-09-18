<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{

	/**
	 * @return TreeBuilder
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('headsnet_sms');

		$rootNode
			->children()
				->scalarNode('delivery_override')->end()
				->enumNode('dispatcher')
					->values(['dummy', 'esendex'])
					->isRequired()
				->end()
				->arrayNode('esendex')
					->children()
						->scalarNode('account_reference')->end()
						->scalarNode('username')->end()
						->scalarNode('password')->end()
						->scalarNode('vmn')->end()
					->end()
				->end() // esendex
			->end();

		return $treeBuilder;
	}

}
