<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class HeadsnetSmsExtension extends Extension
{
	/**
	 * {@inheritDoc}
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = new Configuration();
		$config = $this->processConfiguration($configuration, $configs);

		$loader = new YamlFileLoader(
			$container,
			new FileLocator(__DIR__ . '/../Resources/config')
		);
		$loader->load('services.yml');

		$container->setParameter('headsnet_sms.delivery_override', $config['delivery_override']);
		$container->setParameter('headsnet_sms.esendex.vmn', $config['esendex']['vmn']);

		if ($config['dispatcher'] == 'esendex')
		{
			$container->setAlias(
				'headsnet_sms.dispatcher.class',
				'Headsnet\Sms\Dispatchers\EsendexDispatcher'
			);
		}
		else
		{
			$container->setAlias(
				'headsnet_sms.dispatcher.class',
				'Headsnet\Sms\Dispatchers\DummyDispatcher'
			);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAlias()
	{
		return 'headsnet_sms';
	}

}
