<?php

namespace Message\Mothership\Report\Chart;

abstract class AbstractChart implements ChartInterface
{
	protected $_columns;
	protected $_data;

	/**
	 * Returns the data
	 *
	 * @return string    A JSON representation of the data.
	 */
	public function getData()
	{
		return $this->_data;
	}

	/**
	 * Returns the columns
	 *
	 * @return string     A JSON representation of the data.
	 */
	public function getColumns()
	{
		return $this->_columns;
	}

	/**
	 * Sets the data for the chart
	 *
	 * @param string $data   A JSON representation of the data.
	 *
	 * @return $this
	 */
	public function setData($data)
	{
		$this->_data = $data;

		return $this;
	}

	/**
	 * Sets the columns for the chart
	 *
	 * @param string $columns   A JSON representation of the columns.
	 *
	 * @return $this
	 */
	public function setColumns($columns)
	{
		$this->_columns = $columns;

		return $this;
	}

}