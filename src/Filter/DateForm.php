<?php

namespace Message\Mothership\Report\Filter;

class DateForm implements FilterInterface
{
	private $_date;

	public function __construct($date = null)
	{
		$this->_date = $date;
	}

	public function getForm()
	{
		return new Form\DateForm;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName()
	{
		return 'date_form';
	}

	/**
	 * Gets the date to filter
	 *
	 * @return \DateTime the start date
	 */
	public function getDateChoice()
	{
		return $this->_date;
	}

	/**
	 * Sets the date to filter
	 *
	 * @return \DateTime the start date
	 */
	public function setDateChoice($date)
	{
		return $this->_date = $date;
	}

}