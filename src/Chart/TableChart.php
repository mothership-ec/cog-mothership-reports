<?php

namespace Message\Mothership\Report\Chart;

class TableChart implements ChartInterface
{
	public function getView()
	{
		return "Message:Motership:Report::charts:table";
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