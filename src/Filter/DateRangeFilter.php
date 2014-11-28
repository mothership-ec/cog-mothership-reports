<?php

namespace Message\Mothership\Report\Filter;

class DateRangeFilter implements FilterInterface
{
	private $_to;
	private $_from;

	public function __construct($to = null, $from = null)
	{
		$this->_to   = $to;
		$this->_from = $from;
	}

	public function getForm()
	{
		return new Form\DateFilterForm;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName()
	{
		return 'filter_date';
	}

	/**
	 * Gets the date to filter from
	 * 
	 * @return \DateTime the start date
	 */
	public function getStartDate()
	{
		return $this->_from;
	}

	/**
	 * Gets the date to filter to
	 * 
	 * @return \DateTime the end date
	 */
	public function getEndDate()
	{
		return $this->_to;
	}

	/**
	 * Sets the date to filter from
	 * 
	 * @return \DateTime the start date
	 */
	public function setStartDate($date)
	{
		return $this->_from = $date;
	}

	/**
	 * Sets the date to filter to
	 * 
	 * @return \DateTime the end date
	 */
	public function setEndDate($date)
	{
		return $this->_to = $date;
	}
}