<?php

namespace Message\Mothership\Report\Report;

use Message\Mothership\Report\Filter\Collection as FilterCollection;

interface ReportInterface
{
	/**
	 * Gets the name set for report.
	 *
	 * @return string       The report name.
	 */
	public function getName();

	/**
	 * Gets the display name set for report.
	 *
	 * @return string       The report display name.
	 */
	public function getDisplayName();

	/**
	 * Gets the description about the report.
	 *
	 * @return string       The report description.
	 */
	public function getDescription();

	/**
	 * Gets the group the report as been set to.
	 *
	 * @return string       The report group.
	 */
	public function getReportGroup();

	/**
	 * Generate a URL from a route name.
	 *
	 * @see \Message\Cog\Routing\UrlGenerator::generate()
	 *
	 * @param string         $routeName     Name of the route to use
	 * @param array          $params        Parameters to use in the route
	 * @param boolean|string $referenceType The type of reference (one of the
	 *                                      constants in UrlGeneratorInterface)
	 *
	 * @return string        The generated URL
	 */
	public function generateUrl($routeName, $params = array(), $absolute = UrlGeneratorInterface::ABSOLUTE_PATH);

	/**
	 * Retrieves JSON representation of the data and columns.
	 * Applies data to chart types set on report.
	 *
	 * @return array  Returns all types of chart set on report with appropriate data.
	 */
	public function getCharts();

	/**
	 * Set columns for use in reports.
	 *
	 * @return string  Returns columns in JSON format.
	 */
	public function getColumns();

	/**
	 * Adds filters to the report
	 *
	 * @param  array  $data  The filters to add to the report
	 *
	 * @return $this  Return $this for chainability
	 */
	public function setFilters(FilterCollection $data);

	/**
	 * Gets the filters on the report
	 *
	 * @return FilterCollection The report filters
	 */
	public function getFilters();

	/**
	 * Runs query and turns data into array.
	 *
	 * @return array  Returns data as an array.
	 */
	public function getData();
}