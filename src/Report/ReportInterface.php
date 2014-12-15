<?php

namespace Message\Mothership\Report\Report;

use Message\Mothership\Report\Filter\Collection as FilterCollection;

interface ReportInterface
{
	public function getName();

	public function getDisplayName();

	public function getDescription();

	public function getReportGroup();

	public function generateUrl($routeName, $params = array(), $absolute = UrlGeneratorInterface::ABSOLUTE_PATH);

	/**
	 * Adds filters to the report
	 *
	 * @param  array $data The filters to add to the report
	 * @return $this       Return $this for chainability
	 */
	public function setFilters(FilterCollection $data);

	/**
	 * Gets the filters on the report
	 *
	 * @return FilterCollection the filters
	 */
	public function getFilters();
}