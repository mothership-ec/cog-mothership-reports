<?php

namespace Message\Mothership\Report\Chart;

class PieChart extends AbstractChart
{
	public function getView()
	{
		return "charts:pie.html.twig";
	}
}