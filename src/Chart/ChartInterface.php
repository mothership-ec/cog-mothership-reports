<?php

namespace Message\Mothership\Report\Chart;

interface ChartInterface
{
	public function getView();

	public function setData($data);

	public function setColumns($columns);
}