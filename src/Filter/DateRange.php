<?php

namespace Message\Mothership\Report\Filter;

class DateRange implements FilterInterface
{
	private $_from;
	private $_to;

	/**
	 * Constructor.
	 *
	 * @param  \DateTime     $to
	 * @param  \DateTime     $from
	 */
	public function __construct($to = null, $from = null)
	{
		$this->_to   = $to;
		$this->_from = $from;
	}

	/**
	 * Gets the form for the filter.
	 *
	 * @return Form\DateRange the form
	 */
	public function getForm()
	{
		return new Form\DateRange($this->getStartDate(), $this->getEndDate());
	}

	/**
	 * Gets the names of the filter.
	 *
	 * @return String the name
	 */
	public function getName()
	{
		return 'date_range';
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
	public function setStartDate($from)
	{
		return $this->_from = $from;
	}

	/**
	 * Sets the date to filter to
	 *
	 * @return \DateTime the end date
	 */
	public function setEndDate($to)
	{
		return $this->_to = $to;
	}
}