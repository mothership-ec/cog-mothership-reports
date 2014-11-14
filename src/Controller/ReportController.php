<?php

namespace Message\Mothership\Report\Controller;

use Message\Cog\Controller\Controller;

class ReportController extends Controller
{
	public function showReport($reportName)
	{
		try {
			$report = $this->get('report.collection')->get($reportName);
		} catch (\InvalidArgumentException $e) {
			$this->addFlash('error', 'Could not find report ' . $reportName);
			return $this->redirectToReferer();
		}

		return $this->render('Message:Mothership:Report::report_view', [
			'report' => $report
		]);
	}
}