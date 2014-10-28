<?php

namespace Message\Mothership\Report\Controller;

use Message\Cog\Controller\Controller as BaseController;

class DashboardController extends BaseController
{
	public function index()
	{
		$reports = $this->get('report.collection');
		$reportGroups = [];

		foreach ($reports as $report) {
			if(!in_array($report->reportGroup, $reportGroups)){
				$reportGroups[$report->reportGroup]['name'] = $report->reportGroup;
			}

			$reportGroups[$report->reportGroup][] = $report;
		}

		return $this->render('Message:Mothership:Report::dashboard', [
				'reportGroups' => $reportGroups
			]);
	}
}