<?php namespace UniformWares\Reports\Controller\Report;

use Message\Cog\Controller\Controller;
use UniformWares\Reports\Report as Report;

class View extends Controller
{

	public function index($slug)
	{
		$report = $this->get('report.reports')->get($slug)->value;
		return $report->index($this);
	}

}