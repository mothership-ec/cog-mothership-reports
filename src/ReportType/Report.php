<?php namespace Message\Mothership\Report\ReportType;

use ReflectionClass;
use Message\Cog\DB\Query;
use Message\Cog\Controller\Controller;
use Message\Cog\Filesystem\Filesystem;
use Message\Cog\Filesystem\StreamWrapperInterface;

abstract class Report {

	protected $_filesystem;
	protected $_stream;
	protected $_query;
	protected $_controller;

	public function __construct(Filesystem $filesystem, StreamWrapperInterface $stream, Query $query)
	{
		$this->_filesystem = $filesystem;
		$this->_stream = $stream;
		$this->_query = $query;
	}

	/**
	 * Get the index view for the report.
	 *
	 * @param  Controller $controller
	 * @return Message\Cog\HTTP\Request
	 */
	public function index(Controller $controller)
	{
		$this->_controller = $controller;
		return $this->view();
	}

	/**
	 * Get the report view.
	 *
	 * @return Message\Cog\HTTP\Request
	 */
	public function view($params = array())
	{
		return $this->_controller->render($this->getView(), $params + array(
			'data' => (isset($params['data'])) ? $params['data'] : $this->getData(),
			'report' => $this
		));
	}

	/**
	 * Get the data to display on the report.
	 *
	 * @return array | Iterable
	 */
	public function getData()
	{
		return array();
	}

	/**
	 * Get the view template name.
	 *
	 * @return string
	 */
	public function getView()
	{
		$c = new ReflectionClass($this);
		return '::report:' . strtolower($c->getShortName());
	}

	/**
	 * Get the report name.
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'Report';
	}

	/**
	 * Get the report description.
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->getName();
	}

}