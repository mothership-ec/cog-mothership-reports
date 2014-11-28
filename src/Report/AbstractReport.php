<?php

namespace Message\Mothership\Report\Report;

use Message\Cog\DB\QueryBuilderInterface;
use Message\Cog\DB\QueryBuilderFactory;
use Message\Cog\Localisation\Translator;
use Message\Cog\Routing\UrlGenerator;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Message\Mothership\Report\Filter\Collection as FilterCollection;

abstract class AbstractReport implements ReportInterface
{
	public $name;
	public $displayName;
	public $reportGroup;

	protected $_builderFactory;
	protected $_trans;
	protected $_filters;
	
	private $_routingGenerator;

	public function __construct(QueryBuilderFactory $builderFactory, Translator $trans, UrlGenerator $routingGenerator)
	{
		$this->_builderFactory = $builderFactory;
		$this->_trans = $trans;
		$this->_routingGenerator = $routingGenerator;
		$this->_filters  = new FilterCollection;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDisplayName()
	{
		return $this->_displayName;
	}

	public function getReportGroup()
	{
		return $this->_reportGroup;
	}

	public function generateUrl($routeName, $params = array(), $absolute = UrlGeneratorInterface::ABSOLUTE_PATH)
	{
		// if(null === $this->routingGenerator)
		// {
		// 	//throw new logic exception "did you override construct?"
		// }

		return $this->_routingGenerator->generate($routeName, $params, $absolute);
	}

	/**
	 * {@inheritDoc}
	 */
	public function setFilters(FilterCollection $filters)
	{
		$this->_filters = $filters;

		return $this;
	}

	public function getFilters()
	{
		return $this->_filters;
	}
}