<?php

namespace Message\Mothership\Report\Chart;

class PieChart extends AbstractChart
{
	public function getView()
	{
		return "Message:Mothership:Report::charts:pie";
	}
}