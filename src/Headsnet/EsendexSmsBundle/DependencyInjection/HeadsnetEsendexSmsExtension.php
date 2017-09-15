<?php

namespace Headsnet\EsendexSmsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class HeadsnetEsendexSmsExtension extends Extension
{
	/**
	 * {@inheritDoc}
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$loader = new YamlFileLoader(
			$container,
			new FileLocator(__DIR__ . '/../Resources/config')
		);
		$loader->load('services.yml');

		$configuration = new Configuration();

		$config = $this->processConfiguration($configuration, $configs);

		$def = $container->getDefinition(SmsBuilderCommonData::class);
		$def->replaceArgument(0, $config['company']['name']);
		$def->replaceArgument(1, $config['company']['email']);
		$def->replaceArgument(2, $config['company']['phone']);
		$def->replaceArgument(3, $config['company']['brand_name']);

		$def = $container->getDefinition(EmailBuilderCommonData::class);
		$def->replaceArgument(0, $config['company']['name']);
		$def->replaceArgument(1, $config['company']['email']);
		$def->replaceArgument(2, $config['company']['phone']);
		$def->replaceArgument(3, $config['company']['brand_name']);

		$def = $container->getDefinition('msg.sms.esendex.authentication');
		$def->replaceArgument(0, $config['esendex']['account_reference']);
		$def->replaceArgument(1, $config['esendex']['username']);
		$def->replaceArgument(2, $config['esendex']['password']);
	}

}
