<?php

namespace Message\Mothership\Report\Report;

interface ReportInterface
{
	public function getName();

	public function getFilters();

	public function getCharts();
}