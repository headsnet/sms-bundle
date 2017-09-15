<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\DependencyInjection;

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
		$rootNode = $treeBuilder->root('headsnet_esendex_sms');

		$rootNode
			->children()
				->arrayNode('sms_message')
					->children()
						->scalarNode('entity_class')
						->end()
					->end()
				->end()
				->arrayNode('company')
					->children()
						->scalarNode('name')
							->isRequired()
							->cannotBeEmpty()
						->end()
						->scalarNode('email')
							->isRequired()
							->cannotBeEmpty()
						->end()
						->scalarNode('phone')
							->isRequired()
							->cannotBeEmpty()
						->end()
						->scalarNode('brand_name')
							->isRequired()
							->cannotBeEmpty()
						->end()
					->end()
				->end() // company
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
