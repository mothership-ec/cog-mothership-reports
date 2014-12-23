<?php

namespace Message\Mothership\Report\Report\AppendQuery;

use Message\Mothership\Report\Filter\Collection as FilterCollection;


interface AppendQueryInterface
{
	/**
	 * Builds elements of a query that's to be appended to a main query.
	 *
	 * @return Query
	 */
	public function getQueryBuilder();
}