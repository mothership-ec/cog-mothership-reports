<?php

namespace Message\Mothership\Report\Event;

use Message\Mothership\Report\Report\ReportInterface;
use Message\Mothership\Report\Report\Collection as ReportCollection;

class BuildReportCollectionEvent extends ReportEvent
{
	private $_reports;

	/**
	 * Constructor.
	 *
	 * @param ReportCollection   $collection
	 */
	public function __construct(ReportCollection $collection)
	{
		$this->_reports = $collection;
	}

	/**
	 * Register report
	 *
	 * @param ReportInterface $report report to register
	 */
	public function registerReport(ReportInterface $report)
	{
		$this->_reports->add($report);

		return $this;
	}

	/**
	 * Return the reports collection
	 *
	 * @return ReportCollection the reports
	 */
	public function getReports()
	{
		return $this->_reports;
	}
}