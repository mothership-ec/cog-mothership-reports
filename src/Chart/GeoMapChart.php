<?php

namespace Message\Mothership\Report\Chart;

class GeoMapChart extends AbstractChart
{
	public function getView()
	{
		return "charts:geomap.html.twig";
	}
}