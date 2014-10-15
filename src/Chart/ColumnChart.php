<?php

namespace Message\Mothership\Report\Chart;

class ColumnChart extends AbstractChart
{
	public function getView()
	{
		return "charts:column.html.twig";
	}
}