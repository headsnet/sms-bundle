<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle;

use Headsnet\SmsBundle\DependencyInjection\Compiler\SmsSenderTemplateMappingPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Bundle class
 */
class HeadsnetSmsBundle extends Bundle
{

	/**
	 * @param ContainerBuilder $container
	 */
	public function build(ContainerBuilder $container)
	{
		parent::build($container);

		$container->addCompilerPass(new SmsSenderTemplateMappingPass());
	}

}
