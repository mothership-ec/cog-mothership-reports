<?php

namespace Message\Mothership\Report\Chart;

abstract class AbstractChart implements ChartInterface
{
	protected $_data;

	public function setData(array $data)
	{
		$this->data = $data;
	}
}