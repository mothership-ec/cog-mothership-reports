<?php

namespace Message\Mothership\Report\Form;

use Message\Cog\Service\ContainerAwareInterface;
use Message\Cog\Service\ContainerInterface;
use Symfony\Component\Form\AbstractExtension;

class ReportExtension extends AbstractExtension implements ContainerAwareInterface
{
	protected $_container;
	public function setContainer(ContainerInterface $container)
	{
		$this->_container = $container;
		return $this;
	}
	protected function loadTypes()
	{
		return [
			new DateRange,
		];
	}
}