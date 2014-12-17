<?php

namespace Message\Mothership\Report\Report;

use Message\Cog\DB\QueryBuilderInterface;
use Message\Cog\DB\QueryBuilderFactory;
use Message\Cog\Routing\UrlGenerator;
use Message\Cog\FileDownload\Csv;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Message\Mothership\Report\Filter\Collection as FilterCollection;

abstract class AbstractReport implements ReportInterface
{
	public $name;
	public $displayName;
	public $description;
	public $reportGroup;

	protected $_builderFactory;
	protected $_filters;

	private $_routingGenerator;

	/**
	 * Constructor.
	 *
	 * @param QueryBuilderFactory   $builderFactory
	 * @param UrlGenerator          $routingGenerator
	 * @param DispatcherInterface   $eventDispatcher
	 */
	public function __construct(QueryBuilderFactory $builderFactory, UrlGenerator $routingGenerator)
	{
		$this->_builderFactory = $builderFactory;
		$this->_routingGenerator = $routingGenerator;
		$this->_filters  = new FilterCollection;
	}

	/**
	 * Gets the name set for report.
	 *
	 * @return string       The report name.
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Gets the display name set for report.
	 *
	 * @return string       The report display name.
	 */
	public function getDisplayName()
	{
		return $this->_displayName;
	}

	/**
	 * Gets the description about the report.
	 *
	 * @return string       The report description.
	 */
	public function getDescription()
	{
		return $this->_description;
	}

	/**
	 * Gets the group the report as been set to.
	 *
	 * @return string       The report group.
	 */
	public function getReportGroup()
	{
		return $this->_reportGroup;
	}

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
	public function generateUrl($routeName, $params = array(), $absolute = UrlGeneratorInterface::ABSOLUTE_PATH)
	{
		return $this->_routingGenerator->generate($routeName, $params, $absolute);
	}

	/**
	 * Adds filters to the report
	 *
	 * @param  array   $data    The filters to add to the report
	 *
	 * @return $this   Return $this for chainability
	 */
	public function setFilters(FilterCollection $filters)
	{
		$this->_filters = $filters;

		return $this;
	}

	/**
	 * Gets the filters on the report.
	 *
	 * @return FilterCollection  The reports filters
	 */
	public function getFilters()
	{
		return $this->_filters;
	}

	/**
	 * Runs query and turns data into array.
	 *
	 * @return array  Returns data as an array.
	 */
	public function getData()
	{
		return $this->_dataTransform($this->_getQuery()->run());
	}

	/**
	 * Runs query and turns data into array.
	 *
	 * @param  array  $columns  Takes array of column names & data types.
	 *
	 * @return array  Returns columns as string in JSON format
	 */
	protected function _parseColumns(array $columns)
	{
		$parsed = [];

		foreach ($columns as $name => $type) {
			$parsed[] = ['type' => $type, 'name' => $name];
		}

		return json_encode($parsed);
	}

	/**
	 * Takes the data and transforms it into a useable format.
	 *
	 * @param  DB\Result     $data     The data from the report query.
	 * @param  string|null   $output   The type of output required.
	 *
	 * @return string|array  Returns data as string in JSON format or array.
	 */
	abstract protected function _dataTransform($data, $output = null);

	/**
	 * Dispatches event to get all sales, returns & shipping queries.
	 *
	 * Unions all sub queries & creates parent query.
	 * Sum all totals and grouping by DATE & CURRENCY.
	 * Order by DATE.
	 *
	 * @return Query
	 */
	abstract protected function _getQuery();
}