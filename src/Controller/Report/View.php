<?php

namespace Message\Mothership\Report\Controller\Report;

use Message\Cog\Controller\Controller;

class View extends Controller
{
	public function index($slug)
	{
		$report = $this->get('report.reports')->get($slug)->value;

		return $report->index($this);
	}
}