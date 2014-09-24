<?php

namespace Message\Mothership\Report;

/**
 * Abstract Report class to handle the filter and chart collections.
 */
abstract class AbstractReport implements ReportInterface
{
	private $_filters;
	private $_charts;

	public function setFilters(Collection $filters)
	{
		$this->_filters = $filters;
	}

	public function setCharts(Collection $charts)
	{
		$this->_charts = $charts;
	}

	public function getFilters()
	{
		return $_filters;
	}

	public function getCharts()
	{
		return $_charts;
	}

}
