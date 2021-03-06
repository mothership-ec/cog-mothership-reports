<?php

namespace Message\Mothership\Report\Event;

use Message\Cog\Event\Event;
use Message\Cog\DB\QueryBuilder;
use Message\Mothership\Report\Filter\Collection as FilterCollection;

class ReportEvent extends Event
{
	private $_queryBuilders = [];
	private $_filters;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->_filters = new FilterCollection;
	}

	/**
	 * Returns all the QueryBuilders for query appends.
	 *
	 * @return array An array of QueryBuilders
	 */
	public function getQueryBuilders()
	{
		return $this->_queryBuilders;
	}

	/**
	 * Adds a sub-query to the array of QueryBuilders.
	 *
	 * @param QueryBuilder $queryBuilder
	 */
	public function addQueryBuilder(QueryBuilder $queryBuilder)
	{
		$this->_queryBuilders[] = $queryBuilder;
	}

	/**
	 * Sets the filters for the query appends to use.
	 *
	 * @param FilterCollection $filters
	 *
	 * @return $this
	 */
	public function setFilters(FilterCollection $filters)
	{
		$this->_filters = $filters;

		return $this;
	}

	/**
	 * Returns the filters to be used in query appends.
	 *
	 * @return FilterCollection
	 */
	public function getFilters()
	{
		return $this->_filters;
	}
}