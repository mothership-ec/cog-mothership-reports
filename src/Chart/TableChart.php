<?php

namespace Message\Mothership\Report\Chart;

class TableChart extends AbstractChart
{
	public function getView()
	{
		return "Message:Mothership:Report::charts:table";
	}
}