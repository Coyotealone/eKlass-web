<?php

namespace Coyote\ApiBundle;

use Coyote\ApiBundle\DependencyInjection\Security\Factory\WsseFactory;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class CoyoteApiBundle extends Bundle
{
	/*public function build(ContainerBuilder $container)
	{
		parent::build($container);
	
		$extension = $container->getExtension('security');
		$extension->addSecurityListenerFactory(new WsseFactory());
	}*/
}
