<?php

namespace Message\Mothership\Report\Chart;

interface ChartInterface
{
	/**
	 * Returns the view file for the chart
	 *
	 * @return string  This is the reference for the view file of the chart.
	 */
	public function getView();

	/**
	 * Sets the data for the chart
	 *
	 * @param string $data      A JSON representation of the data.
	 */
	public function setData($data);

	/**
	 * Sets the columns for the chart
	 *
	 * @param string $columns   A JSON representation of the columns.
	 */
	public function setColumns($columns);
}