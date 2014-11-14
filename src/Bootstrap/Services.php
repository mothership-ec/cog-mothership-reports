<?php

namespace Message\Mothership\Report\Bootstrap;

use Message\Cog\Bootstrap\ServicesInterface;
use Message\Mothership\Report;

class Services implements ServicesInterface
{
	public function registerServices($services)
	{
		$services['report.collection'] = function($c) {
			// Build report collection
			$reports = new Report\Report\Collection;

			$event = $c['event.dispatcher']->dispatch(
				Report\Event\Events::REGISTER_REPORTS,
				new Report\Event\BuildReportCollectionEvent($reports)
			);

			return $reports;
		};

		$services->extend('form.extensions', function($extensions,$c) {
			$extensions->add(new Report\Form\ReportExtension);

			return $extensions;
		});
	}
}