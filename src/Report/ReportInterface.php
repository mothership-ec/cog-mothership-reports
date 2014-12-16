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
	 * Retrieves JSON representation of the data and columns.
	 * Applies data to chart types set on report.
	 *
	 * @return Array  Returns all types of chart set on report with appropriate data.
	 */
	public function getCharts();

	/**
	 * Set columns for use in reports.
	 *
	 * @return String  Returns columns in JSON format.
	 */
	public function getColumns();

	/**
	 * Adds filters to the report
	 *
	 * @param  array $data The filters to add to the report
	 *
	 * @return $this       Return $this for chainability
	 */
	public function setFilters(FilterCollection $data);

	/**
	 * Gets the filters on the report
	 *
	 * @return FilterCollection the filters
	 */
	public function getFilters();

	public function getData();
}