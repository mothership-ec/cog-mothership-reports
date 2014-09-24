<?php

namespace Message\Mothership\Report;

interface ReportInterface
{
	public function getName();

	public function getFilters();

	public function getCharts();
}