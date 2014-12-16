<?php

namespace Message\Mothership\Report\Chart;

interface ChartInterface
{
	/**
	 * Returns the view file for the chart
	 *
	 * @return
	 */
	public function getView();

	/**
	 * Sets the data for the chart
	 *
	 * @param String $data      A JSON representation of the data
	 */
	public function setData($data);

	/**
	 * Sets the columns for the chart
	 *
	 * @param String $columns   A JSON representation of the columns
	 */
	public function setColumns($columns);
}