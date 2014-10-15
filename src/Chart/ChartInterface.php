<?php

namespace Message\Mothership\Report\Chart;

interface ChartInterface
{
	public function getView();

	public function setData(array $data);
}