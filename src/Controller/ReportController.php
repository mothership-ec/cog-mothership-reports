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
}