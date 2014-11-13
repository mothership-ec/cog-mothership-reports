<?php

namespace Message\Mothership\Report\Event;

use Message\Cog\Event\Event;
use Message\Cog\DB\QueryBuilder;

class ReportEvent extends Event
{
	private $_queryBuilders = [];

	public function getQueryBuilders()
	{
		return $this->_queryBuilders;
	}

	public function addQueryBuilder(QueryBuilder $queryBuilder)
	{
		$this->_queryBuilders[] = $queryBuilder;
	}

}