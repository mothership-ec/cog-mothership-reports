<?php

namespace Message\Mothership\Report\Chart;

abstract class AbstractChart implements ChartInterface
{

	public function setData($data)
	{
		$this->data = $data;
	}

	public function setColumns($columns)
	{
		$this->columns = $columns;
	}

}