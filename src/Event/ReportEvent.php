<?php

namespace Message\Mothership\Report\Event;

use Message\Cog\Event\Event;
use Message\Cog\DB\QueryBuilder;
use Message\Mothership\Report\Filter\Collection as FilterCollection;

class ReportEvent extends Event
{
	private $_queryBuilders = [];
	private $_filters;

	public function __construct()
	{
		$this->_filters = new FilterCollection;
	}

	public function getQueryBuilders()
	{
		return $this->_queryBuilders;
	}

	public function addQueryBuilder(QueryBuilder $queryBuilder)
	{
		$this->_queryBuilders[] = $queryBuilder;
	}

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