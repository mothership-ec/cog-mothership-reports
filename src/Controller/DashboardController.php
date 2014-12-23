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

			if(!in_array($report->getReportGroup(), $reportGroups)){
				$reportGroups[$report->getReportGroup()]['name'] = $report->getReportGroup();
			}

			$reportGroups[$report->getReportGroup()][] = $report;
		}

		return $this->render('Message:Mothership:Report::dashboard', [
			'reportGroups' => $reportGroups
		]);
	}
}