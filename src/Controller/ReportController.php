<?php

namespace Message\Mothership\Report\Controller;

use Message\Cog\Controller\Controller;
use Message\Cog\FileDownload\Csv\Download;
use Message\Cog\FileDownload\Csv\Table;

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

		/**
		 * @todo  move to IoC
		 */
		$form = new \Message\Mothership\Report\Filter\Form\FilterForm(
			new \Message\Mothership\Report\Filter\Form\DataTransformer($report->getFilters())
		);

		if($report->getFilters()->count()) {
			$form = $this->createForm($form, null, ['filters' => $report->getFilters()]);
			$form->handleRequest();
		} else {
			$form = NULL;
		}

 		return $this->render('Message:Mothership:Report::report_view', [
			'form' => $form,
			'report' => $report
		]);
	}

	public function download($reportName)
	{
		try {
			$report = $this->get('report.collection')->get($reportName);
		} catch (\InvalidArgumentException $e) {
			$this->addFlash('error', 'Could not find report ' . $reportName);
			return $this->redirectToReferer();
		}

		$keys = [array_keys($report->getColumns())];
		$data = array_merge($keys, $report->getData());
		$table = new Table($data);

		$download = new Download($table);

		return $download->download($reportName);
	}
}