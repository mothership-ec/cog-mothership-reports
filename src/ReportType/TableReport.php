<?php

namespace Message\Mothership\Report\ReportType;

abstract class TableReport extends Report
{
	protected $data;

	/**
	 * Default to the table report view.
	 *
	 * @return string
	 */
	public function getView()
	{
		return '::report:tablereport';
	}

	/**
	 * Get the columns for the table.
	 *
	 * @return array
	 */
	public function getColumns()
	{
		return array();
	}

	/**
	 * Format a column's value for rendering on the template.
	 *
	 * @param  string $column
	 * @param  string $value
	 * @return string
	 */
	public function formatColumn($column, $value)
	{
		return $value;
	}
}