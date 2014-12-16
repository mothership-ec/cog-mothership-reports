<?php

namespace Message\Mothership\Report\Chart;

abstract class AbstractChart implements ChartInterface
{
	/**
	 * Sets the data for the chart
	 *
	 * @param String $data   A JSON representation of the data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}

	/**
	 * Sets the columns for the chart
	 *
	 * @param String $columns   A JSON representation of the columns
	 */
	public function setColumns($columns)
	{
		$this->columns = $columns;
	}

}