<?php

namespace Message\Mothership\Report\Chart;

class PieChart implements ChartInterface
{
	public function getView()
	{
		return "charts:pie.html.twig";
	}

	public function setColumns(array $columns)
	{
		$this->_columns = $columns;
	}

	public function setData(array $data)
	{
		$this->_data = $data;
	}
}