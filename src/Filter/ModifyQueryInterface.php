<?php

namespace Message\Mothership\Report\Filter;

use Message\Cog\DB\QueryBuilder;

/**
 * Interface ModifyQueryInterface
 * @package Message\Mothership\Report\Report\AppendQuery
 *
 * @author  Thomas Marchant <thomas@mothership.ec>
 *
 * Interface for modifying query rather than uniting another query with it
 */
interface ModifyQueryInterface
{
	/**
	 * @param QueryBuilder $queryBuilder
	 *
	 * Apply a modification to the main report query, e.g. adding a new where statement
	 */
	public function apply(QueryBuilder $queryBuilder);
}