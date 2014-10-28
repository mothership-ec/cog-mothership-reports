<?php

namespace Message\Mothership\Report\Chart;

class ColumnChart extends AbstractChart
{
	public function getView()
	{
		return "Message:Mothership:Report::charts:column";
	}
}