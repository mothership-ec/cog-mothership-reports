<?php

namespace Message\Mothership\Report\Chart;

class GeoMapChart extends AbstractChart
{
	public function getView()
	{
		return "Message:Mothership:Report::charts:geo-map";
	}
}