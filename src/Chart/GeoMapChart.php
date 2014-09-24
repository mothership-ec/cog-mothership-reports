<?php

namespace Message\Mothership\Report\Chart;

class GeoMapChart implements ChartInterface
{
	public function getView()
	{
		return "charts:geomap.html.twig";
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