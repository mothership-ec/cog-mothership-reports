<?php

namespace Message\Mothership\Report\Report\AppendQuery;

use Message\Mothership\Report\Filter\Collection as FilterCollection;

interface FilterableInterface extends AppendQueryInterface
{
	/**
	 * Sets the filters from the report.
	 *
	 * @param Filter\Collection $filters
	 *
	 * @return  $this  Return $this for chainability
	 */
	public function setFilters(FilterCollection $filters);
}